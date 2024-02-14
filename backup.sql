--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1
-- Dumped by pg_dump version 16.1

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: auto; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.auto (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    anno character varying(255) NOT NULL,
    prezzo character varying(255) NOT NULL,
    img character varying(255)
);


ALTER TABLE public.auto OWNER TO www;

--
-- Name: auto_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE public.auto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auto_id_seq OWNER TO www;

--
-- Name: auto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE public.auto_id_seq OWNED BY public.auto.id;


--
-- Name: garage; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.garage (
    id integer NOT NULL,
    username character varying(255) NOT NULL
);


ALTER TABLE public.garage OWNER TO www;

--
-- Name: garage_auto; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.garage_auto (
    id integer NOT NULL,
    auto_id integer NOT NULL,
    garage_id integer NOT NULL
);


ALTER TABLE public.garage_auto OWNER TO www;

--
-- Name: garage-auto_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE public."garage-auto_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."garage-auto_id_seq" OWNER TO www;

--
-- Name: garage-auto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE public."garage-auto_id_seq" OWNED BY public.garage_auto.id;


--
-- Name: garage_id_seq; Type: SEQUENCE; Schema: public; Owner: www
--

CREATE SEQUENCE public.garage_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.garage_id_seq OWNER TO www;

--
-- Name: garage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: www
--

ALTER SEQUENCE public.garage_id_seq OWNED BY public.garage.id;


--
-- Name: utenti; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.utenti (
    username character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.utenti OWNER TO www;

--
-- Name: auto id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.auto ALTER COLUMN id SET DEFAULT nextval('public.auto_id_seq'::regclass);


--
-- Name: garage id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage ALTER COLUMN id SET DEFAULT nextval('public.garage_id_seq'::regclass);


--
-- Name: garage_auto id; Type: DEFAULT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage_auto ALTER COLUMN id SET DEFAULT nextval('public."garage-auto_id_seq"'::regclass);


--
-- Data for Name: auto; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.auto (id, nome, anno, prezzo, img) FROM stdin;
0	Ford Mustang	1967	40000	Mustang
1	Volkswagen Beetle	1938	15000\n	Volkswagen
2	Chevrolet Impala	1958	50000	Chevrolet
3	Porsche 911	1963	150000	Porsche
4	Jaguar E-TYPE	1961\n	170000	Jaguar
5	Toyota 2000GT	1961	500000	Toyota
6	BMW 2002	1968	40000	BMW
7	Lamborghini Miura	1966	1600000	Lamborghini
8	Alfa Romeo Giulia GTV	1965	50000	Alfa Romeo Giulia GTV 1965
9	Mercedes Benz 300SL	1954	1100000	Benz
10	Ferrari F40	1987	1300000	F40
11	Fiat 500	1957	15000	Fiat 500 1957
13	Citroen DS	1955	35000	Citroen
14	Aston Martin DB5	1963	500000	Aston Martin
15	Shelby Cobra	1962	500000	Shelby
12	Lancia Delta Integrale \n	1989	120000	Delta
\.


--
-- Data for Name: garage; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.garage (id, username) FROM stdin;
1	gianni
2	mario
\.


--
-- Data for Name: garage_auto; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.garage_auto (id, auto_id, garage_id) FROM stdin;
34	1	1
36	0	1
37	6	1
\.


--
-- Data for Name: utenti; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.utenti (username, email, password) FROM stdin;
simone	simoneguerra2002@gmail.com	$2y$10$GmSvK3u7gSmzL5KH3Xwz5uVL4Ua3eYVMRXC46w2cuf28m78PQDppq
gianni	gianniwar@hotmail.it	$2y$10$sUNXaZOgFWr5yklPVwZkN.s97eh6P6tKAwaic3cDr4Z35Dmngq.JK
mario	mario@gmail.com	$2y$10$.v3rPFcLrmtXWcwZbiMhB.Kjpf9KidKUHhPOt2FfDle2XdHpdX2CC
\.


--
-- Name: auto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: www
--

SELECT pg_catalog.setval('public.auto_id_seq', 6, true);


--
-- Name: garage-auto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: www
--

SELECT pg_catalog.setval('public."garage-auto_id_seq"', 44, true);


--
-- Name: garage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: www
--

SELECT pg_catalog.setval('public.garage_id_seq', 2, true);


--
-- Name: auto auto_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.auto
    ADD CONSTRAINT auto_pkey PRIMARY KEY (id);


--
-- Name: garage_auto garage-auto_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage_auto
    ADD CONSTRAINT "garage-auto_pkey" PRIMARY KEY (auto_id);


--
-- Name: garage garage_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage
    ADD CONSTRAINT garage_pkey PRIMARY KEY (id);


--
-- Name: utenti utenti_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_pkey PRIMARY KEY (username);


--
-- Name: garage_auto fk_auto; Type: FK CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage_auto
    ADD CONSTRAINT fk_auto FOREIGN KEY (auto_id) REFERENCES public.auto(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: garage_auto fk_garage; Type: FK CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage_auto
    ADD CONSTRAINT fk_garage FOREIGN KEY (garage_id) REFERENCES public.garage(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: garage fk_username; Type: FK CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.garage
    ADD CONSTRAINT fk_username FOREIGN KEY (username) REFERENCES public.utenti(username) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

