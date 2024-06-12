<?php

namespace App\DataTables\Front;

use App\Models\PerumahanModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class PerumahanDataTable extends DataTable
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
            ->addColumn('action', 'front.datatables.perumahan_action')
            ->addColumn('number', 0)
            /* ->addColumn('getKategori', function (PerumahanModel $perumahan) {
                return $perumahan->getKategori->title;
            }) */
            /* ->editColumn('kategori', function (PerumahanModel $perumahan) {
                return $perumahan->getKategori()->first()?->title;
            }) */
            ->filterColumn('kategori', function ($query, $keywords) use ($request) {
                $query->where('kategori','like','%'.$keywords.'%');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PerumahanModel $model,Request $request): QueryBuilder
    {
        $q =  $model->newQuery();

        $columns = $request->columns ?? [];
        if (count($columns) > 0) {
            foreach ($columns as $i => $c) {
                $data = $c['data'];
                
                    if(isset ($c['search']) and !empty($c['search']) and $data == 'no_bast')
                    {
                        if($c['search'] == 'Sudah BAST')
                        {
                            $q->where(function($query) use ($c) {
                                $query->whereNotNull('no_bast')->where('no_bast','<>','');
                            });
                        }elseif($c['search'] == 'Belum BAST'){
                            $q->where(function($query) use ($c) {
                                $query->where(function($query1) {
                                    $query1->whereNull('no_bast')->orWhere('no_bast','=','');
                                });
                            });
                        }
                    }else if(isset ($c['search']) and !empty($c['search']) and ($data == 'kabkota_id' or $data == 'kecamatan_id' or $data == 'tahun_siteplan'))
                    {
                        $q->where(function($query) use ($c) {
                            $query->orWhere($c['data'], 'like', $c['search']['value']);
                        });
                    }
                }
        }

        return $q->orderBy('id','desc');
        //return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('perumahans-table')
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
                    /* window.LaravelDataTables["perumahans-table"].buttons().container()
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
            //Column::make('kabkota_id')->title('Kabkota')->searchable(true)->visible(false),
            //Column::make('kecamatan_id')->title('Kecamatan')->searchable(true)->visible(false),
            //Column::make('kelurahan_id')->title('Kelurahan')->searchable(true)->visible(false),
            Column::make('nama_perumahan')->title('Nama Perumahan')->searchable(true),
            Column::make('nama_pengembang')->title('Pengembang')->searchable(true),
            Column::make('alamat')->title('Alamat')->searchable(true)->visible(false),
            Column::make('luas')->title('Luas')->searchable(true),
            Column::make('tahun_siteplan')->title('Tahun Siteplan')->searchable(true),
            //Column::make('latitude')->title('Latitude')->searchable(true),
            //Column::make('longitude')->title('Longitude')->searchable(true),
            //Column::make('latlong')->title('Koordinat')->searchable(true),
            Column::make('total_unit')->title('Total Unit')->searchable(true),
            //Column::make('jumlah_mbr')->title('Jumlah MBR')->searchable(true),
            //Column::make('jumlah_nonmbr')->title('Jumlah NonMBR')->searchable(true),
            //Column::make('no_bast')->title('No BAST')->searchable(true),
            //Column::make('file_bast')->title('File BAST')->searchable(true),
            //Column::make('photo')->title('Photo')->searchable(true),
            //Column::make('siteplan')->title('Siteplan')->searchable(true),
            //Column::make('created_at')->title('Tgl Input')->searchable(true)->visible(false),
            //Column::make('updated_at')->title('Tgl Update')->searchable(true)->visible(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Perumahans_' . date('YmdHis');
    }

}
