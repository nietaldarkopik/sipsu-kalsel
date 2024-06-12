<?php

namespace App\DataTables\Front;

use App\Models\JenisPsuModel;
use App\Models\PerumahanModel;
use App\Models\PermukimanModel;
use App\Models\PsuModel;
use App\Models\PsuPermukimanModel;
use App\Models\PsuPerumahanModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use DB;

class PsuDataTable extends DataTable
{
    //protected $actions = ['print', 'excel'];

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'front.datatables.psu_action')
            ->addColumn('number', 0)
            ->addColumn('id_jenis_psu', function (PsuPermukimanModel $psu) {
                return JenisPsuModel::find($psu->id_jenis_psu)->title;
            })
            ->addColumn('id_psu', function (PsuPermukimanModel $psu) {
                return PsuModel::find($psu->id_psu)->judul;
            })
            ->addColumn('id_permukiman', function (PsuPermukimanModel $psu) {
                if($psu->jenis_perkim == 'perumahan')
                {
                    return PerumahanModel::find($psu->id_permukiman)->nama_perumahan;
                }else{
                    return PermukimanModel::find($psu->id_permukiman)->nama_permukiman;
                }
            })
            /* ->editColumn('kategori', function (PsuPermukimanModel $psu) {
                return $psu->getKategori()->first()?->title;
            }) 
            ->filterColumn('kategori', function ($query, $keywords) use ($request) {
                $query->where('kategori','like','%'.$keywords.'%');
                })
            */
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PsuPermukimanModel $model,Request $request): QueryBuilder
    {
        $psuPerumahan = PsuPerumahanModel
            ::select(
            DB::raw("('perumahan') as jenis_perkim"),
            'id',
            'id_perumahan as id_permukiman',
            'id_jenis_psu',
            'id_kategori',
            'id_psu',
            'nama_psu',
            'deskripsi',
            'bast_status',
            'bast_file',
            'bast_tanggal',
            'kondisi',
            //'latitude',
            //'longitude',
            //'latlong',
            'photo'
        );//->with('getPerumahan');

        $q = $model->newQuery();
        $q->select(
            DB::raw("('permukiman') as jenis_perkim"),
            'id',
            'id_permukiman',
            'id_jenis_psu',
            'id_kategori',
            'id_psu',
            'nama_psu',
            'deskripsi',
            'bast_status',
            'bast_file',
            'bast_tanggal',
            'kondisi',
            //'latitude',
            //'longitude',
            //'latlong',
            'photo'
        );
        $q->union($psuPerumahan);

        $columns = $request->columns ?? [];
        if (count($columns) > 0) {
            foreach ($columns as $i => $c) {
                $data = $c['data'];

                if (isset($c['search']) and !empty($c['search']) and $data == 'no_bast') {
                    if ($c['search'] == 'Sudah BAST') {
                        $q->where(function ($query) use ($c) {
                            $query->whereNotNull('no_bast')->where('no_bast', '<>', '');
                        });
                    } elseif ($c['search'] == 'Belum BAST') {
                        $q->where(function ($query) use ($c) {
                            $query->where(function ($query1) {
                                $query1->whereNull('no_bast')->orWhere('no_bast', '=', '');
                            });
                        });
                    }
                } else if (isset($c['search']) and !empty($c['search']) and ($data == 'kabkota_id' or $data == 'kecamatan_id' or $data == 'tahun_siteplan')) {
                    $q->where(function ($query) use ($c) {
                        $query->orWhere($c['data'], 'like', $c['search']['value']);
                    });
                }
            }
        }

        return $q->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('psus-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->buttons([
                //Button::make('excel'),
                //Button::make('csv'),
                //Button::make('pdf'),
                //Button::make('print'),
                //Button::make('reset'),
                //Button::make('reload'),
                //Button::make('searchPanes'),
            ])
            //dom:'lBfrtip',
            ->dom('lBfrtip')
            
            //->destroy(true)
            //->fixedHeader(true)
            //->responsive(true)
            //->serverSide(true)
            //->stateSave(true)
            //->processing(true)
            //->pageLength(100)
            //->dom($this->domHtml)

            ->orderBy(2)
            ->selectStyleSingle()
            ->parameters([
                'drawCallback' => 'function() { $(\'[data-tooltip]\').tooltip({}); }',
                'initComplete' => 'function () {
                    /* window.LaravelDataTables["psus-table"].buttons().container()
                     .appendTo( ".justify-content-stretch") */
                 }',
                'responsive' => [
                    'details' => true
                ],
                'buttons' => [
                    //Button::make('excel'),
                    //Button::make('csv'),
                    //Button::make('pdf'),
                    //Button::make('print'),
                    //Button::make('reset'),
                    //Button::make('reload'),
                    //Button::make('searchPanes'),
                    
                    'excel',
                    'csv',
                    'pdf',
                    'print',
                    'reset',
                    'reload',
                    'searchPanes',
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('number')
            ->title('#')
            ->render('meta.row + meta.settings._iDisplayStart + 1;')
            ->width(50)
            ->orderable(false)
            ->searchable(false),
            Column::make('jenis_perkim')->title('Jenis Perkim')->searchable(true),
            Column::make('id_permukiman')->title('Nama')->searchable(true),
            //Column::make('id_kategori')->title('Kategori')->searchable(true),
            Column::make('id_jenis_psu')->title('Jenis PSU')->searchable(true),
            Column::make('id_psu')->title('PSU')->searchable(true),
            Column::make('nama_psu')->title('Nama PSU')->searchable(true),
            //Column::make('deskripsi')->title('Deskripsi')->searchable(true),
            //Column::make('bast_status')->title('Bast Status')->searchable(true),
            //Column::make('bast_file')->title('Bast File')->searchable(true),
            //Column::make('bast_tanggal')->title('Bast Tanggal')->searchable(true),
            //Column::make('latitude')->title('Latitude')->searchable(true),
            //Column::make('longitude')->title('Longitude')->searchable(true),
            //Column::make('jenis_perumahan')->title('Jenis Perumahan')->searchable(true),
            //Column::make('photo')->title('Photo')->searchable(true),
            //Column::make('latlong')->title('Latlong')->searchable(true),
            Column::make('kondisi')->title('Kondisi')->searchable(true),
            //Column::make('created_at')->title('Created At')->searchable(true),
            //Column::make('updated_at')->title('Updated At')->searchable(true),
            //Column::make('deleted_at')->title('Deleted At')->searchable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Psus_' . date('YmdHis');
    }

}
