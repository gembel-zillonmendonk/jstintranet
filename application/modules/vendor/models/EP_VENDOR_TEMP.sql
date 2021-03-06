ALTER TABLE EP_VENDOR_TEMP
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP
(
  KODE_VENDOR             INTEGER,
  NAMA_VENDOR             VARCHAR2(50 BYTE),
  KODE_LOGIN              VARCHAR2(50 BYTE),
  PASSWRD                 VARCHAR2(255 BYTE),
  ALAMAT_EMAIL            VARCHAR2(255 BYTE),
  AWALAN                  VARCHAR2(50 BYTE),
  AWALAN_LAIN             VARCHAR2(50 BYTE),
  AKHIRAN                 VARCHAR2(50 BYTE),
  AKHIRAN_LAIN            VARCHAR2(50 BYTE),
  ALAMAT                  VARCHAR2(512 BYTE),
  KOTA                    VARCHAR2(512 BYTE),
  PROPINSI                VARCHAR2(512 BYTE),
  KODE_POS                VARCHAR2(50 BYTE),
  NEGARA                  VARCHAR2(255 BYTE),
  NO_TELP                 VARCHAR2(50 BYTE),
  WEBSITE                 VARCHAR2(512 BYTE),
  NO_DOMISILI             VARCHAR2(50 BYTE),
  TGL_DOMISILI            DATE,
  KADALUARSA_DOMISILI     DATE,
  NAMA_KONTAK             VARCHAR2(255 BYTE),
  JABATAN_KONTAK          VARCHAR2(255 BYTE),
  NO_TELP_KONTAK          VARCHAR2(50 BYTE),
  EMAIL_KONTAK            VARCHAR2(100 BYTE),
  NPP                     VARCHAR2(50 BYTE),
  TGL_NPP                 DATE,
  NO_NPWP                 VARCHAR2(50 BYTE),
  ALAMAT_NPWP             VARCHAR2(255 BYTE),
  KOTA_NPWP               VARCHAR2(100 BYTE),
  PROPINSI_NPWP           VARCHAR2(100 BYTE),
  KODE_POS_NPWP           VARCHAR2(50 BYTE),
  PKP_NPWP                VARCHAR2(50 BYTE),
  NO_PKP_NPWP             VARCHAR2(100 BYTE),
  TIPE_VENDOR             VARCHAR2(100 BYTE),
  TIPE_SIUP_IUJK          VARCHAR2(50 BYTE),
  SIUP_DITERBITKAN_OLEH   VARCHAR2(255 BYTE),
  NO_SIUP                 VARCHAR2(50 BYTE),
  TIPE_SIUP               VARCHAR2(50 BYTE),
  DARI_TGL_SIUP           DATE,
  SAMPAI_TGL_SIUP         DATE,
  TDP_ISSUED_BY           VARCHAR2(255 BYTE),
  NO_TDP                  VARCHAR2(50 BYTE),
  DARI_TGL_TDP            DATE,
  SAMPAI_TGL_TDP          DATE,
  AGEN_PENERBIT           VARCHAR2(255 BYTE),
  DARI_AGEN               DATE,
  HINGGA_AGEN             DATE,
  PENERBIT_IMP            VARCHAR2(255 BYTE),
  DARI_IMP                DATE,
  KE_IMP                  DATE,
  ATT_ORG                 VARCHAR2(50 BYTE),
  MATA_UANG_MODAL_DASAR   VARCHAR2(3 BYTE),
  MODAL_DASAR             NUMBER(19,4),
  MATA_UANG_MODAL_SETOR   VARCHAR2(3 BYTE),
  MODAL_SETOR             NUMBER(19,4),
  MATA_UANG_ASSET_DASAR   VARCHAR2(3 BYTE),
  ASSET_DASAR             NUMBER(19,4),
  MATA_UANG_LAPORAN_KEU   VARCHAR2(3 BYTE),
  TAHUN_LAPORAN_KEU       INTEGER,
  TIPE_LAPORAN_KEU        VARCHAR2(50 BYTE),
  ASSET_LAPORAN_KEU       NUMBER(19,4),
  HUTANG_LAPORAN_KEU      NUMBER(19,4),
  PENDAPATAN_LAPORAN_KEU  NUMBER(19,4),
  LABA_LAPORAN_KEU        NUMBER(19,4),
  GOLONGAN_KEUANGAN       CHAR(1 BYTE),
  BERAKHIR_DARI           DATE,
  BERAKHIR_SAMPAI         DATE,
  DIAKHIRI_OLEH           VARCHAR2(50 BYTE),
  TGL_REKAM               DATE,
  TGL_UBAH                DATE,
  PETUGAS_UBAH            VARCHAR2(50 BYTE),
  STATUS                  VARCHAR2(2 BYTE),
  HALAMAN_SELANJUTNYA     VARCHAR2(255 BYTE),
  KODE_STATUS_REG         INTEGER,
  STATUS_REG              CHAR(1 BYTE),
  SESSION_ID_REG          VARCHAR2(512 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_PK
  PRIMARY KEY
  (KODE_VENDOR)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_FK 
  FOREIGN KEY (KODE_STATUS_REG) 
  REFERENCES EP_VENDOR_STATUS_REGISTRASI (KODE_STATUS_REG)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_AGEN
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_AGEN CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_AGEN
(
  KODE_VENDOR    INTEGER,
  TIPE           VARCHAR2(50 BYTE),
  PENERBIT       VARCHAR2(250 BYTE),
  TGL_BUAT       DATE,
  TGL_BERAKHIR   DATE,
  NO             VARCHAR2(150 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_AGEN_PK
  PRIMARY KEY
  (NO, TIPE, KODE_VENDOR)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_AGEN_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_AKTA
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_AKTA CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_AKTA
(
  KODE_VENDOR       INTEGER,
  TIPE_AKTA         VARCHAR2(50 BYTE),
  NO_AKTA           VARCHAR2(50 BYTE),
  TGL_PEMBUATAN     DATE,
  NAMA_NOTARIS      VARCHAR2(50 BYTE),
  ALAMAT_NOTARIS    VARCHAR2(255 BYTE),
  PENGESAHAN_HAKIM  DATE,
  BERITA_ACARA_NGR  DATE,
  TGL_REKAM         DATE,
  PETUGAS_REKAM     VARCHAR2(10 BYTE),
  TGL_UBAH          DATE,
  PETUGAS_UBAH      VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_AKTA_PK
  PRIMARY KEY
  (KODE_VENDOR, TIPE_AKTA)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_AKTA_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_ALAMAT
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_ALAMAT CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_ALAMAT
(
  KODE_VENDOR    INTEGER,
  TIPE           VARCHAR2(255 BYTE),
  ALAMAT         VARCHAR2(255 BYTE),
  KOTA           VARCHAR2(50 BYTE),
  NEGARA         VARCHAR2(255 BYTE),
  KODE_POS       VARCHAR2(50 BYTE),
  NO_TELP1       VARCHAR2(50 BYTE),
  NO_TELP2       VARCHAR2(50 BYTE),
  FAX            VARCHAR2(50 BYTE),
  WEBSITE        VARCHAR2(50 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_ALAMAT_PK
  PRIMARY KEY
  (KODE_VENDOR, TIPE)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_ALAMAT_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_BANK
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_BANK CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_BANK
(
  KODE_VENDOR    INTEGER,
  NO_REKENING    VARCHAR2(50 BYTE),
  NAMA_REKENING  VARCHAR2(255 BYTE),
  NAMA_BANK      VARCHAR2(50 BYTE),
  CABANG         VARCHAR2(50 BYTE),
  MATA_UANG      VARCHAR2(50 BYTE),
  ALAMAT         VARCHAR2(255 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_BANK_PK
  PRIMARY KEY
  (KODE_VENDOR, NO_REKENING)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_BANK_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_BARANG
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_BARANG CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_BARANG
(
  KODE_VENDOR    INTEGER,
  NAMA_BARANG    VARCHAR2(255 BYTE),
  KODE_BARANG    VARCHAR2(50 BYTE),
  KETERANGAN     VARCHAR2(1024 BYTE),
  MEREK          VARCHAR2(50 BYTE),
  SUMBER         VARCHAR2(50 BYTE),
  TIPE           VARCHAR2(50 BYTE),
  TERDAFTAR      CHAR(1 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_BARANG_PK
  PRIMARY KEY
  (KODE_VENDOR, NAMA_BARANG)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_BARANG_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_DEWAN_DIREKSI
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_DEWAN_DIREKSI CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_DEWAN_DIREKSI
(
  KODE_VENDOR    INTEGER,
  TIPE           VARCHAR2(50 BYTE),
  NAMA           VARCHAR2(512 BYTE),
  JABATAN        VARCHAR2(255 BYTE),
  NO_TELP        VARCHAR2(50 BYTE),
  EMAIL          VARCHAR2(255 BYTE),
  NO_KTP         VARCHAR2(255 BYTE),
  NO_NPWP        VARCHAR2(255 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_D_DIREKSI_PK
  PRIMARY KEY
  (JABATAN, NAMA, TIPE, KODE_VENDOR)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_D_DIREKSI_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_IJIN
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_IJIN CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_IJIN
(
  KODE_VENDOR    INTEGER,
  TIPE           VARCHAR2(50 BYTE),
  PENERBIT       VARCHAR2(250 BYTE),
  NO             VARCHAR2(50 BYTE),
  TGL_MULAI      DATE,
  TGL_BERAKHIR   DATE,
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_IJIN_PK
  PRIMARY KEY
  (KODE_VENDOR, TIPE)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_IJIN_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_INFORMASI_LAIN
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_INFORMASI_LAIN CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_INFORMASI_LAIN
(
  KODE_VENDOR    INTEGER,
  TIPE           VARCHAR2(100 BYTE),
  NAMA           VARCHAR2(255 BYTE),
  ALAMAT         VARCHAR2(255 BYTE),
  KOTA           VARCHAR2(50 BYTE),
  NEGARA         VARCHAR2(50 BYTE),
  KODE_POS       VARCHAR2(50 BYTE),
  KUALIFIKASI    VARCHAR2(1024 BYTE),
  HUBUNGAN       VARCHAR2(255 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_INFO_LAIN_PK
  PRIMARY KEY
  (KODE_VENDOR, TIPE)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_INFO_LAIN_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_JASA
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_JASA CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_JASA
(
  KODE_VENDOR    INTEGER,
  KODE_JASA      VARCHAR2(50 BYTE),
  NAMA_JASA      VARCHAR2(255 BYTE),
  TIPE           VARCHAR2(50 BYTE),
  TERDAFTAR      CHAR(1 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_JASA_PK
  PRIMARY KEY
  (KODE_VENDOR, KODE_JASA)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_JASA_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_KINERJA
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_KINERJA CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_KINERJA
(
  KODE_VENDOR           INTEGER,
  TANGGAL               DATE,
  KODE_TENDER           VARCHAR2(10 BYTE),
  TIPE_KOMODITI         CHAR(1 BYTE),
  KODE_KEL_JASA_BARANG  VARCHAR2(20 BYTE),
  KODE_PARAM            VARCHAR2(50 BYTE),
  NAMA_PARAM            VARCHAR2(255 BYTE),
  PILIHAN_PARAM         INTEGER,
  TGL_REKAM             DATE,
  PETUGAS_REKAM         VARCHAR2(10 BYTE),
  TGL_UBAH              DATE,
  PETUGAS_UBAH          VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_KINERJA_PK
  PRIMARY KEY
  (KODE_VENDOR, KODE_TENDER)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_KINERJA_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_LAP_KEUANGAN
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_LAP_KEUANGAN CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_LAP_KEUANGAN
(
  KODE_VENDOR    INTEGER,
  MATA_UANG      VARCHAR2(3 BYTE),
  TAHUN          INTEGER,
  TIPE           VARCHAR2(50 BYTE),
  NILAI_ASSET    NUMBER(19,4),
  HUTANG         NUMBER(19,4),
  PENDAPATAN     NUMBER(19,4),
  LABA_BERSIH    NUMBER(19,4),
  KELAS          CHAR(1 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VND_TEMP_L_KEU_PK
  PRIMARY KEY
  (KODE_VENDOR, MATA_UANG, TAHUN, TIPE)
  ENABLE VALIDATE,
  CONSTRAINT EP_VND_TEMP_L_KEU_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_PENGALAMAN
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_PENGALAMAN CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_PENGALAMAN
(
  KODE_VENDOR    INTEGER,
  NAMA           VARCHAR2(255 BYTE),
  NAMA_PROYEK    VARCHAR2(255 BYTE),
  MATA_UANG      VARCHAR2(3 BYTE),
  NILAI          NUMBER(19,4),
  TGL_MULAI      DATE,
  TGL_BERAKHIR   DATE,
  KONTAK         VARCHAR2(255 BYTE),
  NO_KONTAK      VARCHAR2(50 BYTE),
  NO_KONTRAK     VARCHAR2(50 BYTE),
  KETERANGAN     VARCHAR2(4000 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_PENGALAMAN_PK
  PRIMARY KEY
  (KODE_VENDOR, NAMA, NAMA_PROYEK)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_PENGALAMAN_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_PERALATAN
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_PERALATAN CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_PERALATAN
(
  KODE_VENDOR      INTEGER,
  KATEGORI         VARCHAR2(50 BYTE),
  NAMA_PERALATAN   VARCHAR2(255 BYTE),
  SPESIFIKASI      VARCHAR2(512 BYTE),
  TAHUN_PEMBUATAN  INTEGER,
  JUMLAH           NUMBER(18),
  TGL_REKAM        DATE,
  PETUGAS_REKAM    VARCHAR2(10 BYTE),
  TGL_UBAH         DATE,
  PETUGAS_UBAH     VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_PERALATAN_PK
  PRIMARY KEY
  (KODE_VENDOR, NAMA_PERALATAN)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_PERALATAN_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_SERTIFIKAT
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_SERTIFIKAT CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_SERTIFIKAT
(
  KODE_VENDOR     INTEGER,
  NAMA            VARCHAR2(255 BYTE),
  PENERBIT        VARCHAR2(255 BYTE),
  TIPE            VARCHAR2(50 BYTE),
  TIPE_LAIN       VARCHAR2(50 BYTE),
  BERLAKU_DARI    DATE,
  BERLAKU_HINGGA  DATE,
  NO_SERTIFIKAT   VARCHAR2(50 BYTE),
  TGL_REKAM       DATE,
  PETUGAS_REKAM   VARCHAR2(10 BYTE),
  TGL_UBAH        DATE,
  PETUGAS_UBAH    VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_SERTIFIKAT_PK
  PRIMARY KEY
  (KODE_VENDOR, NAMA)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_SERTIFIKAT_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_TENAGA_KERJA
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_TENAGA_KERJA CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_TENAGA_KERJA
(
  KODE_VENDOR          INTEGER,
  NAMA                 VARCHAR2(255 BYTE),
  TIPE                 VARCHAR2(50 BYTE),
  PENDIDIKAN_TERAKHIR  VARCHAR2(50 BYTE),
  KEAHLIAN             VARCHAR2(1024 BYTE),
  TAHUN_BERAKHIR       INTEGER,
  STATUS_PEGAWAI       VARCHAR2(50 BYTE),
  TIPE_PEGAWAI         VARCHAR2(50 BYTE),
  TGL_REKAM            DATE,
  PETUGAS_REKAM        VARCHAR2(10 BYTE),
  TGL_UBAH             DATE,
  PETUGAS_UBAH         VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_TENAGA_KERJA_PK
  PRIMARY KEY
  (KODE_VENDOR, NAMA)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_TENAGA_KERJA_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_TIPE
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_TIPE CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_TIPE
(
  KODE_VENDOR    INTEGER,
  TIPE_VENDOR    VARCHAR2(255 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_TIPE_PK
  PRIMARY KEY
  (KODE_VENDOR, TIPE_VENDOR)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_TIPE_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);


ALTER TABLE EP_VENDOR_TEMP_WILAYAH
 DROP PRIMARY KEY CASCADE;

DROP TABLE EP_VENDOR_TEMP_WILAYAH CASCADE CONSTRAINTS;

CREATE TABLE EP_VENDOR_TEMP_WILAYAH
(
  KODE_WILAYAH   INTEGER,
  KODE_VENDOR    INTEGER,
  KODE2_WILAYAH  INTEGER,
  WILAYAH        VARCHAR2(255 BYTE),
  NO_SMK         VARCHAR2(50 BYTE),
  TGL_SMK        DATE,
  BERLAKU_SMK    DATE,
  STATUS_AKTIF   CHAR(1 BYTE),
  TGL_REKAM      DATE,
  PETUGAS_REKAM  VARCHAR2(10 BYTE),
  TGL_UBAH       DATE,
  PETUGAS_UBAH   VARCHAR2(10 BYTE),
  CONSTRAINT EP_VENDOR_TEMP_WILAYAH_PK
  PRIMARY KEY
  (KODE_WILAYAH, KODE_VENDOR)
  ENABLE VALIDATE,
  CONSTRAINT EP_VENDOR_TEMP_WILAYAH_FK 
  FOREIGN KEY (KODE_VENDOR) 
  REFERENCES EP_VENDOR_TEMP (KODE_VENDOR)
  ON DELETE CASCADE
);
