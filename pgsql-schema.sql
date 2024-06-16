--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2
-- Dumped by pg_dump version 16.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: content_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.content_types (
    id bigint NOT NULL,
    code character varying(255) NOT NULL,
    title character varying(255) NOT NULL
);


ALTER TABLE public.content_types OWNER TO postgres;

--
-- Name: content_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.content_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.content_types_id_seq OWNER TO postgres;

--
-- Name: content_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.content_types_id_seq OWNED BY public.content_types.id;


--
-- Name: contents; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contents (
    id bigint NOT NULL,
    id_content_type bigint NOT NULL,
    description text NOT NULL,
    slug character varying(255)
);


ALTER TABLE public.contents OWNER TO postgres;

--
-- Name: contents_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contents_id_seq OWNER TO postgres;

--
-- Name: contents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contents_id_seq OWNED BY public.contents.id;


--
-- Name: districts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.districts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.districts_id_seq OWNER TO postgres;

--
-- Name: districts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.districts (
    id bigint DEFAULT nextval('public.districts_id_seq'::regclass) NOT NULL,
    regency_id bigint NOT NULL,
    name character varying NOT NULL,
    alt_name character varying DEFAULT ''::character varying,
    latitude double precision DEFAULT 0,
    longitude double precision DEFAULT 0
);


ALTER TABLE public.districts OWNER TO postgres;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: jenis_psu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jenis_psu (
    id bigint NOT NULL,
    title character varying(255),
    deskripsi text,
    kategori integer
);


ALTER TABLE public.jenis_psu OWNER TO postgres;

--
-- Name: jenis_psu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jenis_psu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jenis_psu_id_seq OWNER TO postgres;

--
-- Name: jenis_psu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jenis_psu_id_seq OWNED BY public.jenis_psu.id;


--
-- Name: kategori_psu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori_psu (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    deskripsi text
);


ALTER TABLE public.kategori_psu OWNER TO postgres;

--
-- Name: kategori_psu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kategori_psu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kategori_psu_id_seq OWNER TO postgres;

--
-- Name: kategori_psu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kategori_psu_id_seq OWNED BY public.kategori_psu.id;


--
-- Name: menu_groups; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menu_groups (
    id bigint NOT NULL,
    code character varying(255) NOT NULL,
    title character varying(255) NOT NULL
);


ALTER TABLE public.menu_groups OWNER TO postgres;

--
-- Name: menu_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menu_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.menu_groups_id_seq OWNER TO postgres;

--
-- Name: menu_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menu_groups_id_seq OWNED BY public.menu_groups.id;


--
-- Name: menus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menus (
    id bigint NOT NULL,
    menu_group_id bigint,
    parent_id bigint,
    code character varying(255) NOT NULL,
    title character varying(255) NOT NULL,
    sort_order bigint
);


ALTER TABLE public.menus OWNER TO postgres;

--
-- Name: menus_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.menus_id_seq OWNER TO postgres;

--
-- Name: menus_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menus_id_seq OWNED BY public.menus.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: model_has_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_permissions OWNER TO postgres;

--
-- Name: model_has_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_roles OWNER TO postgres;

--
-- Name: pages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pages (
    id bigint NOT NULL,
    code character varying(255) NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    slug character varying(255)
);


ALTER TABLE public.pages OWNER TO postgres;

--
-- Name: pages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pages_id_seq OWNER TO postgres;

--
-- Name: pages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pages_id_seq OWNED BY public.pages.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: permukiman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permukiman (
    id bigint NOT NULL,
    provinsi_id bigint DEFAULT 63 NOT NULL,
    kabkota_id bigint NOT NULL,
    kecamatan_id bigint NOT NULL,
    kelurahan_id bigint NOT NULL,
    nama_permukiman character varying(255),
    luas character varying(255),
    latitude character varying(255),
    longitude character varying(255),
    latlong public.geography(Point,4326),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp without time zone,
    tahun_siteplan character varying(4),
    total_unit bigint,
    no_bast character varying(125),
    alamat character varying(250),
    status_data character varying(15),
    user_id_create bigint,
    user_id_update bigint,
    photo character varying(250),
    siteplan character varying(250),
    geometry json,
    geometry_file character varying(250),
    file_survey character varying(250),
    file_bast character varying(250),
    keterangan text
);


ALTER TABLE public.permukiman OWNER TO postgres;

--
-- Name: pemukiman_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pemukiman_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pemukiman_id_seq OWNER TO postgres;

--
-- Name: pemukiman_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pemukiman_id_seq OWNED BY public.permukiman.id;


--
-- Name: pengembang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengembang (
    id bigint NOT NULL,
    nama_pengembang character varying(255),
    alamat character varying(255),
    tlp character varying(255),
    email character varying(255),
    website character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pengembang OWNER TO postgres;

--
-- Name: pengembang_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengembang_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengembang_id_seq OWNER TO postgres;

--
-- Name: pengembang_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengembang_id_seq OWNED BY public.pengembang.id;


--
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.permissions_id_seq OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- Name: perumahan_dokumens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perumahan_dokumens (
    id bigint NOT NULL,
    nama_file character varying(250),
    judul_file character varying(250),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_perumahan bigint
);


ALTER TABLE public.perumahan_dokumens OWNER TO postgres;

--
-- Name: permukiman_dokumens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permukiman_dokumens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.permukiman_dokumens_id_seq OWNER TO postgres;

--
-- Name: permukiman_dokumens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permukiman_dokumens_id_seq OWNED BY public.perumahan_dokumens.id;


--
-- Name: permukiman_dokumens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permukiman_dokumens (
    id bigint DEFAULT nextval('public.permukiman_dokumens_id_seq'::regclass) NOT NULL,
    nama_file character varying(250),
    judul_file character varying(250),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_permukiman bigint
);


ALTER TABLE public.permukiman_dokumens OWNER TO postgres;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: perumahan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perumahan (
    id bigint NOT NULL,
    provinsi_id bigint DEFAULT 63,
    kabkota_id bigint,
    kecamatan_id bigint,
    kelurahan_id bigint,
    pengembang_id bigint,
    nama_perumahan character varying(255),
    luas character varying(255),
    tahun_siteplan character varying(255),
    latitude character varying(255),
    longitude character varying(255),
    latlong public.geography(Point,4326),
    total_unit integer,
    jumlah_mbr integer,
    jumlah_nonmbr integer,
    no_bast character varying(255),
    file_bast character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    photo character varying(250),
    siteplan character varying(250),
    alamat character varying(1024),
    user_id_create bigint,
    status_data character varying(20),
    user_id_update bigint,
    deleted_at timestamp without time zone,
    nama_pengembang character varying(150),
    telepon_pengembang character varying,
    email_pengembang character varying,
    jumlah_proses bigint,
    jumlah_ditempati bigint,
    jumlah_kosong bigint,
    file_survey character varying(250),
    geometry_file character varying(250),
    geometry json,
    keterangan text
);


ALTER TABLE public.perumahan OWNER TO postgres;

--
-- Name: perumahan_dokumens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perumahan_dokumens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.perumahan_dokumens_id_seq OWNER TO postgres;

--
-- Name: perumahan_dokumens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.perumahan_dokumens_id_seq OWNED BY public.perumahan_dokumens.id;


--
-- Name: perumahan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perumahan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.perumahan_id_seq OWNER TO postgres;

--
-- Name: perumahan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.perumahan_id_seq OWNED BY public.perumahan.id;


--
-- Name: perumahan_units; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perumahan_units (
    id bigint NOT NULL,
    perumahan_id bigint,
    type character varying(255),
    total character varying(255),
    realisasi character varying(255)
);


ALTER TABLE public.perumahan_units OWNER TO postgres;

--
-- Name: perumahan_units_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perumahan_units_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.perumahan_units_id_seq OWNER TO postgres;

--
-- Name: perumahan_units_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.perumahan_units_id_seq OWNED BY public.perumahan_units.id;


--
-- Name: provinces; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.provinces (
    id bigint NOT NULL,
    name character varying NOT NULL,
    alt_name character varying DEFAULT ''::character varying NOT NULL,
    latitude double precision DEFAULT 0 NOT NULL,
    longitude double precision DEFAULT 0 NOT NULL
);


ALTER TABLE public.provinces OWNER TO postgres;

--
-- Name: psu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psu (
    id bigint NOT NULL,
    kategori integer,
    jenis integer,
    judul character varying(255),
    deskripsi text
);


ALTER TABLE public.psu OWNER TO postgres;

--
-- Name: psu_attribute_permukiman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psu_attribute_permukiman (
    id bigint NOT NULL,
    id_jenis_psu bigint,
    id_psu bigint,
    value text,
    id_permukiman bigint,
    id_psu_attribute bigint,
    id_psu_permukiman bigint
);


ALTER TABLE public.psu_attribute_permukiman OWNER TO postgres;

--
-- Name: psu_attribute_permukiman_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.psu_attribute_permukiman_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.psu_attribute_permukiman_id_seq OWNER TO postgres;

--
-- Name: psu_attribute_permukiman_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.psu_attribute_permukiman_id_seq OWNED BY public.psu_attribute_permukiman.id;


--
-- Name: psu_attribute_perumahan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psu_attribute_perumahan (
    id bigint NOT NULL,
    id_jenis_psu bigint,
    id_psu bigint,
    value text,
    id_perumahan bigint,
    id_psu_attribute bigint,
    id_psu_perumahan bigint
);


ALTER TABLE public.psu_attribute_perumahan OWNER TO postgres;

--
-- Name: psu_attribute_perumahan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.psu_attribute_perumahan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.psu_attribute_perumahan_id_seq OWNER TO postgres;

--
-- Name: psu_attribute_perumahan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.psu_attribute_perumahan_id_seq OWNED BY public.psu_attribute_perumahan.id;


--
-- Name: psu_attributes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psu_attributes (
    id bigint NOT NULL,
    id_jenis_psu bigint,
    id_psu bigint,
    options text,
    attribute character varying(250),
    keterangan text,
    id_kategori bigint
);


ALTER TABLE public.psu_attributes OWNER TO postgres;

--
-- Name: psu_attributes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.psu_attributes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.psu_attributes_id_seq OWNER TO postgres;

--
-- Name: psu_attributes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.psu_attributes_id_seq OWNED BY public.psu_attributes.id;


--
-- Name: psu_perumahan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psu_perumahan (
    id bigint NOT NULL,
    id_perumahan bigint,
    id_jenis_psu bigint,
    nama_psu character varying(255),
    deskripsi text,
    bast_status character varying(255),
    bast_file text,
    bast_tanggal date,
    latitude character varying(255),
    longitude character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    jenis_perumahan character varying(250),
    deleted_at time without time zone,
    photo character varying,
    latlong point,
    id_psu bigint,
    kondisi character varying(30),
    id_kategori bigint,
    CONSTRAINT psu_bast_status_check CHECK (((bast_status)::text = ANY ((ARRAY['belum'::character varying, 'sudah'::character varying, 'sebagian'::character varying])::text[])))
);


ALTER TABLE public.psu_perumahan OWNER TO postgres;

--
-- Name: psu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.psu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.psu_id_seq OWNER TO postgres;

--
-- Name: psu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.psu_id_seq OWNED BY public.psu_perumahan.id;


--
-- Name: psu_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.psu_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.psu_id_seq1 OWNER TO postgres;

--
-- Name: psu_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.psu_id_seq1 OWNED BY public.psu.id;


--
-- Name: psu_permukiman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psu_permukiman (
    id bigint NOT NULL,
    id_permukiman bigint,
    id_jenis_psu bigint,
    nama_psu character varying(255),
    deskripsi text,
    bast_status character varying(255),
    bast_file text,
    bast_tanggal date,
    latitude character varying(255),
    longitude character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    jenis_permukiman character varying(250),
    deleted_at time without time zone,
    photo character varying,
    latlong point,
    id_psu bigint,
    kondisi character varying(30),
    id_kategori bigint,
    CONSTRAINT psu_bast_status_check CHECK (((bast_status)::text = ANY (ARRAY[('belum'::character varying)::text, ('sudah'::character varying)::text, ('sebagian'::character varying)::text])))
);


ALTER TABLE public.psu_permukiman OWNER TO postgres;

--
-- Name: psu_permukiman_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.psu_permukiman_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.psu_permukiman_id_seq OWNER TO postgres;

--
-- Name: psu_permukiman_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.psu_permukiman_id_seq OWNED BY public.psu_permukiman.id;


--
-- Name: regencies; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.regencies (
    id bigint NOT NULL,
    province_id bigint NOT NULL,
    name character varying NOT NULL,
    alt_name character varying DEFAULT ''::character varying NOT NULL,
    latitude double precision DEFAULT 0 NOT NULL,
    longitude double precision DEFAULT 0 NOT NULL
);


ALTER TABLE public.regencies OWNER TO postgres;

--
-- Name: regencies_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.regencies ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.regencies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: role_has_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.role_has_permissions OWNER TO postgres;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.settings (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.settings OWNER TO postgres;

--
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.settings_id_seq OWNER TO postgres;

--
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.settings_id_seq OWNED BY public.settings.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: villages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.villages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.villages_id_seq OWNER TO postgres;

--
-- Name: villages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.villages (
    id bigint DEFAULT nextval('public.villages_id_seq'::regclass) NOT NULL,
    district_id bigint NOT NULL,
    name character varying NOT NULL,
    alt_name character varying DEFAULT ''::character varying,
    latitude double precision DEFAULT 0,
    longitude double precision DEFAULT 0
);


ALTER TABLE public.villages OWNER TO postgres;

--
-- Name: content_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.content_types ALTER COLUMN id SET DEFAULT nextval('public.content_types_id_seq'::regclass);


--
-- Name: contents id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contents ALTER COLUMN id SET DEFAULT nextval('public.contents_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jenis_psu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_psu ALTER COLUMN id SET DEFAULT nextval('public.jenis_psu_id_seq'::regclass);


--
-- Name: kategori_psu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori_psu ALTER COLUMN id SET DEFAULT nextval('public.kategori_psu_id_seq'::regclass);


--
-- Name: menu_groups id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_groups ALTER COLUMN id SET DEFAULT nextval('public.menu_groups_id_seq'::regclass);


--
-- Name: menus id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus ALTER COLUMN id SET DEFAULT nextval('public.menus_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: pages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pages ALTER COLUMN id SET DEFAULT nextval('public.pages_id_seq'::regclass);


--
-- Name: pengembang id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengembang ALTER COLUMN id SET DEFAULT nextval('public.pengembang_id_seq'::regclass);


--
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- Name: permukiman id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permukiman ALTER COLUMN id SET DEFAULT nextval('public.pemukiman_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: perumahan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perumahan ALTER COLUMN id SET DEFAULT nextval('public.perumahan_id_seq'::regclass);


--
-- Name: perumahan_dokumens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perumahan_dokumens ALTER COLUMN id SET DEFAULT nextval('public.perumahan_dokumens_id_seq'::regclass);


--
-- Name: perumahan_units id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perumahan_units ALTER COLUMN id SET DEFAULT nextval('public.perumahan_units_id_seq'::regclass);


--
-- Name: psu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu ALTER COLUMN id SET DEFAULT nextval('public.psu_id_seq1'::regclass);


--
-- Name: psu_attribute_permukiman id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_attribute_permukiman ALTER COLUMN id SET DEFAULT nextval('public.psu_attribute_permukiman_id_seq'::regclass);


--
-- Name: psu_attribute_perumahan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_attribute_perumahan ALTER COLUMN id SET DEFAULT nextval('public.psu_attribute_perumahan_id_seq'::regclass);


--
-- Name: psu_attributes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_attributes ALTER COLUMN id SET DEFAULT nextval('public.psu_attributes_id_seq'::regclass);


--
-- Name: psu_permukiman id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_permukiman ALTER COLUMN id SET DEFAULT nextval('public.psu_permukiman_id_seq'::regclass);


--
-- Name: psu_perumahan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_perumahan ALTER COLUMN id SET DEFAULT nextval('public.psu_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: settings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings ALTER COLUMN id SET DEFAULT nextval('public.settings_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: content_types content_types_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.content_types
    ADD CONSTRAINT content_types_code_unique UNIQUE (code);


--
-- Name: content_types content_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.content_types
    ADD CONSTRAINT content_types_pkey PRIMARY KEY (id);


--
-- Name: contents contents_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contents
    ADD CONSTRAINT contents_pkey PRIMARY KEY (id);


--
-- Name: districts districts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.districts
    ADD CONSTRAINT districts_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: jenis_psu jenis_psu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_psu
    ADD CONSTRAINT jenis_psu_pkey PRIMARY KEY (id);


--
-- Name: kategori_psu kategori_psu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori_psu
    ADD CONSTRAINT kategori_psu_pkey PRIMARY KEY (id);


--
-- Name: menu_groups menu_groups_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_groups
    ADD CONSTRAINT menu_groups_code_unique UNIQUE (code);


--
-- Name: menu_groups menu_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_groups
    ADD CONSTRAINT menu_groups_pkey PRIMARY KEY (id);


--
-- Name: menus menus_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_code_unique UNIQUE (code);


--
-- Name: menus menus_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: model_has_permissions model_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);


--
-- Name: model_has_roles model_has_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);


--
-- Name: pages pages_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pages
    ADD CONSTRAINT pages_code_unique UNIQUE (code);


--
-- Name: pages pages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pages
    ADD CONSTRAINT pages_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: permukiman pemukiman_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permukiman
    ADD CONSTRAINT pemukiman_pkey PRIMARY KEY (id);


--
-- Name: pengembang pengembang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengembang
    ADD CONSTRAINT pengembang_pkey PRIMARY KEY (id);


--
-- Name: permissions permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- Name: permukiman_dokumens permukiman_dokumens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permukiman_dokumens
    ADD CONSTRAINT permukiman_dokumens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: perumahan_dokumens perumahan_dokumens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perumahan_dokumens
    ADD CONSTRAINT perumahan_dokumens_pkey PRIMARY KEY (id);


--
-- Name: perumahan perumahan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perumahan
    ADD CONSTRAINT perumahan_pkey PRIMARY KEY (id);


--
-- Name: perumahan_units perumahan_units_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perumahan_units
    ADD CONSTRAINT perumahan_units_pkey PRIMARY KEY (id);


--
-- Name: provinces provinces_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.provinces
    ADD CONSTRAINT provinces_pkey PRIMARY KEY (id);


--
-- Name: psu_attribute_permukiman psu_attribute_permukiman_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_attribute_permukiman
    ADD CONSTRAINT psu_attribute_permukiman_pkey PRIMARY KEY (id);


--
-- Name: psu_attribute_perumahan psu_attribute_perumahan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_attribute_perumahan
    ADD CONSTRAINT psu_attribute_perumahan_pkey PRIMARY KEY (id);


--
-- Name: psu_attributes psu_attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_attributes
    ADD CONSTRAINT psu_attributes_pkey PRIMARY KEY (id);


--
-- Name: psu_permukiman psu_permukiman_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_permukiman
    ADD CONSTRAINT psu_permukiman_pkey PRIMARY KEY (id);


--
-- Name: psu_perumahan psu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu_perumahan
    ADD CONSTRAINT psu_pkey PRIMARY KEY (id);


--
-- Name: psu psu_pkey1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psu
    ADD CONSTRAINT psu_pkey1 PRIMARY KEY (id);


--
-- Name: regencies regencies_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.regencies
    ADD CONSTRAINT regencies_pkey PRIMARY KEY (id);


--
-- Name: role_has_permissions role_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);


--
-- Name: roles roles_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: settings settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: villages villages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.villages
    ADD CONSTRAINT villages_pkey PRIMARY KEY (id);


--
-- Name: model_has_permissions_model_id_model_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);


--
-- Name: model_has_roles_model_id_model_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: contents contents_id_content_type_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contents
    ADD CONSTRAINT contents_id_content_type_foreign FOREIGN KEY (id_content_type) REFERENCES public.content_types(id) ON DELETE CASCADE;


--
-- Name: districts districts_regency_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.districts
    ADD CONSTRAINT districts_regency_id_foreign FOREIGN KEY (regency_id) REFERENCES public.regencies(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: jenis_psu jenis_psu_kategori_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_psu
    ADD CONSTRAINT jenis_psu_kategori_foreign FOREIGN KEY (kategori) REFERENCES public.kategori_psu(id) ON DELETE SET NULL;


--
-- Name: menus menus_menu_group_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_menu_group_id_foreign FOREIGN KEY (menu_group_id) REFERENCES public.menu_groups(id) ON DELETE SET NULL;


--
-- Name: menus menus_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES public.menus(id) ON DELETE SET NULL;


--
-- Name: model_has_permissions model_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- Name: model_has_roles model_has_roles_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: regencies regencies_province_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.regencies
    ADD CONSTRAINT regencies_province_id_foreign FOREIGN KEY (province_id) REFERENCES public.provinces(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: role_has_permissions role_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- Name: role_has_permissions role_has_permissions_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: villages villages_district_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.villages
    ADD CONSTRAINT villages_district_id_foreign FOREIGN KEY (district_id) REFERENCES public.districts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

