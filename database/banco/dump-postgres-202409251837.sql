PGDMP         %                |            postgres    15.8    15.8 ;    k           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            l           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            m           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            n           1262    5    postgres    DATABASE        CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE postgres;
                postgres    false            o           0    0    DATABASE postgres    COMMENT     N   COMMENT ON DATABASE postgres IS 'default administrative connection database';
                   postgres    false    3438                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            p           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    6            �            1259    44045 
   categories    TABLE     
  CREATE TABLE public.categories (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    is_pay boolean DEFAULT false NOT NULL,
    is_receive boolean DEFAULT false NOT NULL,
    user_id integer NOT NULL
);
    DROP TABLE public.categories;
       public         heap    postgres    false    6            �            1259    44044    categories_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.categories_id_seq;
       public          postgres    false    6    237            q           0    0    categories_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;
          public          postgres    false    236            �            1259    44097    credit_cards    TABLE       CREATE TABLE public.credit_cards (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    operator character varying(50) NOT NULL,
    credit_limit numeric(10,2) NOT NULL,
    limit_utility numeric(10,2) DEFAULT 0,
    user_id integer NOT NULL
);
     DROP TABLE public.credit_cards;
       public         heap    postgres    false    6            �            1259    44096    credit_cards_id_seq    SEQUENCE     �   CREATE SEQUENCE public.credit_cards_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.credit_cards_id_seq;
       public          postgres    false    6    243            r           0    0    credit_cards_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.credit_cards_id_seq OWNED BY public.credit_cards.id;
          public          postgres    false    242            �            1259    44060    expenses    TABLE     G  CREATE TABLE public.expenses (
    id integer NOT NULL,
    description character varying(50) NOT NULL,
    value numeric(10,2) NOT NULL,
    date_maturity date NOT NULL,
    status boolean DEFAULT false NOT NULL,
    category_id integer NOT NULL,
    user_id integer NOT NULL,
    last_notified timestamp without time zone
);
    DROP TABLE public.expenses;
       public         heap    postgres    false    6            �            1259    44059    expenses_id_seq    SEQUENCE     �   CREATE SEQUENCE public.expenses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.expenses_id_seq;
       public          postgres    false    239    6            s           0    0    expenses_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.expenses_id_seq OWNED BY public.expenses.id;
          public          postgres    false    238            �            1259    44078    receives    TABLE     H  CREATE TABLE public.receives (
    id integer NOT NULL,
    description character varying(50) NOT NULL,
    value numeric(10,2) NOT NULL,
    date_receive date NOT NULL,
    status boolean DEFAULT false NOT NULL,
    is_recurring boolean DEFAULT false NOT NULL,
    category_id integer NOT NULL,
    user_id integer NOT NULL
);
    DROP TABLE public.receives;
       public         heap    postgres    false    6            �            1259    44077    receives_id_seq    SEQUENCE     �   CREATE SEQUENCE public.receives_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.receives_id_seq;
       public          postgres    false    241    6            t           0    0    receives_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.receives_id_seq OWNED BY public.receives.id;
          public          postgres    false    240            �            1259    44111    shopping_cards    TABLE     v  CREATE TABLE public.shopping_cards (
    id integer NOT NULL,
    date_shopping date NOT NULL,
    value_total numeric(10,2) NOT NULL,
    description character varying(100) NOT NULL,
    is_parcel boolean DEFAULT false NOT NULL,
    parcel_number integer,
    parcel_actual integer,
    user_id integer NOT NULL,
    credit_card_id integer,
    origin_parcel_id integer
);
 "   DROP TABLE public.shopping_cards;
       public         heap    postgres    false    6            �            1259    44110    shopping_cards_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_cards_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.shopping_cards_id_seq;
       public          postgres    false    6    245            u           0    0    shopping_cards_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.shopping_cards_id_seq OWNED BY public.shopping_cards.id;
          public          postgres    false    244            �            1259    44031    users    TABLE     �   CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    password text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.users;
       public         heap    postgres    false    6            �            1259    44030    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    235    6            v           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    234            �           2604    44048    categories id    DEFAULT     n   ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);
 <   ALTER TABLE public.categories ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    237    236    237            �           2604    44100    credit_cards id    DEFAULT     r   ALTER TABLE ONLY public.credit_cards ALTER COLUMN id SET DEFAULT nextval('public.credit_cards_id_seq'::regclass);
 >   ALTER TABLE public.credit_cards ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    243    242    243            �           2604    44063    expenses id    DEFAULT     j   ALTER TABLE ONLY public.expenses ALTER COLUMN id SET DEFAULT nextval('public.expenses_id_seq'::regclass);
 :   ALTER TABLE public.expenses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    239    238    239            �           2604    44081    receives id    DEFAULT     j   ALTER TABLE ONLY public.receives ALTER COLUMN id SET DEFAULT nextval('public.receives_id_seq'::regclass);
 :   ALTER TABLE public.receives ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    240    241    241            �           2604    44114    shopping_cards id    DEFAULT     v   ALTER TABLE ONLY public.shopping_cards ALTER COLUMN id SET DEFAULT nextval('public.shopping_cards_id_seq'::regclass);
 @   ALTER TABLE public.shopping_cards ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    244    245    245            �           2604    44034    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    235    234    235            `          0    44045 
   categories 
   TABLE DATA           V   COPY public.categories (id, name, is_active, is_pay, is_receive, user_id) FROM stdin;
    public          postgres    false    237   lF       f          0    44097    credit_cards 
   TABLE DATA           `   COPY public.credit_cards (id, name, operator, credit_limit, limit_utility, user_id) FROM stdin;
    public          postgres    false    243   �F       b          0    44060    expenses 
   TABLE DATA           v   COPY public.expenses (id, description, value, date_maturity, status, category_id, user_id, last_notified) FROM stdin;
    public          postgres    false    239   3G       d          0    44078    receives 
   TABLE DATA           t   COPY public.receives (id, description, value, date_receive, status, is_recurring, category_id, user_id) FROM stdin;
    public          postgres    false    241   �G       h          0    44111    shopping_cards 
   TABLE DATA           �   COPY public.shopping_cards (id, date_shopping, value_total, description, is_parcel, parcel_number, parcel_actual, user_id, credit_card_id, origin_parcel_id) FROM stdin;
    public          postgres    false    245   ?H       ^          0    44031    users 
   TABLE DATA           J   COPY public.users (id, username, email, password, created_at) FROM stdin;
    public          postgres    false    235   �H       w           0    0    categories_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.categories_id_seq', 6, true);
          public          postgres    false    236            x           0    0    credit_cards_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.credit_cards_id_seq', 2, true);
          public          postgres    false    242            y           0    0    expenses_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.expenses_id_seq', 6, true);
          public          postgres    false    238            z           0    0    receives_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.receives_id_seq', 8, true);
          public          postgres    false    240            {           0    0    shopping_cards_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.shopping_cards_id_seq', 13, true);
          public          postgres    false    244            |           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 2, true);
          public          postgres    false    234            �           2606    44053    categories categories_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_pkey;
       public            postgres    false    237            �           2606    44103    credit_cards credit_cards_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.credit_cards
    ADD CONSTRAINT credit_cards_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.credit_cards DROP CONSTRAINT credit_cards_pkey;
       public            postgres    false    243            �           2606    44066    expenses expenses_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.expenses
    ADD CONSTRAINT expenses_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.expenses DROP CONSTRAINT expenses_pkey;
       public            postgres    false    239            �           2606    44085    receives receives_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.receives
    ADD CONSTRAINT receives_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.receives DROP CONSTRAINT receives_pkey;
       public            postgres    false    241            �           2606    44117 "   shopping_cards shopping_cards_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.shopping_cards
    ADD CONSTRAINT shopping_cards_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.shopping_cards DROP CONSTRAINT shopping_cards_pkey;
       public            postgres    false    245            �           2606    44043    users users_email_key 
   CONSTRAINT     Q   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);
 ?   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_key;
       public            postgres    false    235            �           2606    44039    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    235            �           2606    44041    users users_username_key 
   CONSTRAINT     W   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_key;
       public            postgres    false    235            �           2606    44054 "   categories categories_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 L   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_user_id_fkey;
       public          postgres    false    237    3258    235            �           2606    44104 &   credit_cards credit_cards_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.credit_cards
    ADD CONSTRAINT credit_cards_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 P   ALTER TABLE ONLY public.credit_cards DROP CONSTRAINT credit_cards_user_id_fkey;
       public          postgres    false    3258    243    235            �           2606    44067 "   expenses expenses_category_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.expenses
    ADD CONSTRAINT expenses_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id);
 L   ALTER TABLE ONLY public.expenses DROP CONSTRAINT expenses_category_id_fkey;
       public          postgres    false    239    3262    237            �           2606    44072    expenses expenses_user_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.expenses
    ADD CONSTRAINT expenses_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 H   ALTER TABLE ONLY public.expenses DROP CONSTRAINT expenses_user_id_fkey;
       public          postgres    false    235    3258    239            �           2606    44086 "   receives receives_category_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.receives
    ADD CONSTRAINT receives_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id);
 L   ALTER TABLE ONLY public.receives DROP CONSTRAINT receives_category_id_fkey;
       public          postgres    false    3262    237    241            �           2606    44091    receives receives_user_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.receives
    ADD CONSTRAINT receives_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 H   ALTER TABLE ONLY public.receives DROP CONSTRAINT receives_user_id_fkey;
       public          postgres    false    241    235    3258            �           2606    44123 1   shopping_cards shopping_cards_credit_card_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_cards
    ADD CONSTRAINT shopping_cards_credit_card_id_fkey FOREIGN KEY (credit_card_id) REFERENCES public.credit_cards(id);
 [   ALTER TABLE ONLY public.shopping_cards DROP CONSTRAINT shopping_cards_credit_card_id_fkey;
       public          postgres    false    243    3268    245            �           2606    44118 *   shopping_cards shopping_cards_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_cards
    ADD CONSTRAINT shopping_cards_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 T   ALTER TABLE ONLY public.shopping_cards DROP CONSTRAINT shopping_cards_user_id_fkey;
       public          postgres    false    235    245    3258            `   m   x�3�H,JN�ITpN,*��,�4NC.#�Í饉p�1�k^jQz&BĄ�9?7�����ڲ���)gpb��E��`���gHjqIj��cYbNf���C,I��qqq a�'�      f   :   x�3��+MJ����M,.I-rN,J�4700�30�4�҆\F��y@YdEFpE%1z\\\ 9��      b   x   x�3�tK,)-JTI-.I�42�30 �F&�����i�f��H
��V&V�\&���E�W�d��+�*8'�s� �04�54a�1~\f���K9Pl12*1�(����� 9�!S      d   t   x�3�N�9��(3_�75�81�����L��H��X��s�q�p�rrYp�&�^������Z\�����X����xx����@]zp͆`�f@�&$j��hNk����� #e0�      h   �   x�}�=�0��9he�If�N�Y"�	T�1p�^��yb�l��g~B��+*�(0��t�o�ג���8�lG�EZw,���6�V�aC��b�n�ma��-l����a�a{�6v����qk��E�?<�7��iz.�!���������-	��b����mW      ^   �   x�3��)MN,VpI-���L�r2�R���s9U�*UT���K\SS�}��"�2sC<�LS-�s=ӳ,\R"�"+�s�,��M��B�=
��9��Lt,u�ͬLM�LL�,�L,-��b���� V<#8     