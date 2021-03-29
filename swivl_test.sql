--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.19
-- Dumped by pg_dump version 9.6.19

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
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: classroom; Type: TABLE; Schema: public; Owner: dev
--

CREATE TABLE public.classroom (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    is_active boolean NOT NULL
);


ALTER TABLE public.classroom OWNER TO dev;

--
-- Name: classroom_id_seq; Type: SEQUENCE; Schema: public; Owner: dev
--

CREATE SEQUENCE public.classroom_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.classroom_id_seq OWNER TO dev;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: dev
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO dev;

--
-- Data for Name: classroom; Type: TABLE DATA; Schema: public; Owner: dev
--

COPY public.classroom (id, title, created_at, is_active) FROM stdin;
8	1 dq sdq sdq sd1112	2021-03-26 19:49:41	t
9	Test post method 1	2021-03-27 16:37:43	t
11	test classroom 3	2021-03-27 16:48:27	t
7	1	2021-03-26 19:46:09	f
12	3111	2021-03-27 20:31:50	f
13	3111	2021-03-27 20:33:56	f
14	322121111	2021-03-27 20:34:04	f
15	322121111	2021-03-27 20:34:18	f
16	322121111	2021-03-28 09:52:14	f
17	322121111	2021-03-28 09:52:30	t
18	322121111	2021-03-28 09:02:30	t
10	test classroom 2	2021-03-27 16:46:58	f
19	322121111	2021-03-28 09:02:30	t
20	322121111	2021-03-28 09:02:30	t
\.


--
-- Name: classroom_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dev
--

SELECT pg_catalog.setval('public.classroom_id_seq', 20, true);


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: dev
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20210325085136	2021-03-25 10:51:51	17
\.


--
-- Name: classroom classroom_pkey; Type: CONSTRAINT; Schema: public; Owner: dev
--

ALTER TABLE ONLY public.classroom
    ADD CONSTRAINT classroom_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: dev
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- PostgreSQL database dump complete
--

