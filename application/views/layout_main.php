<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Selamat Datang di iPROC - Aplikasi e-Procurement Terintegrasi</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="<?php echo base_url('css/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/custom-theme/jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/ui.jqgrid.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/ui.jqform.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/superfish.css') ?>" rel="stylesheet" media="screen" /> 
        <link href="<?php echo base_url('css/format.css') ?>" rel="stylesheet" type="text/css"/>
		 
        <link href="<?php echo base_url('css/text.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/data.css') ?>" rel="stylesheet" type="text/css"/>

        <script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.0.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/i18n/grid.locale-en.js') ?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.jqGrid.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.23.custom.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.form.js') ?>"></script>         

        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js') ?>"></script>         
        <script type="text/javascript" src="<?php echo base_url('js/jquery.metadata.js') ?>"></script>         
        
        <script type="text/javascript" src="<?php echo base_url('js/jquery-ui-timepicker-addon.js') ?>"></script>        
        <script type="text/javascript">
            $.jgrid.no_legacy_api = true;
            $.jgrid.useJSON = true;
            $.datepicker.setDefaults({
                showOn: 'both',
                buttonImageOnly: true,
                buttonImage: '<?php echo base_url('images/Calendar_scheduleHS.png') ?>',
                buttonText: 'Calendar',
                dateFormat: "yy-mm-dd",
                readOnly: true,
                defaultDate: $('.datepicker').val()
            });
            
            $.timepicker.setDefaults({
                showOn: 'both',
                buttonImageOnly: true,
                buttonImage: '<?php echo base_url('images/Calendar_scheduleHS.png') ?>',
                buttonText: 'Calendar',
                dateFormat: "yy-mm-dd",
                readOnly: true,
                defaultDate: $('.datepicker').val(),
                showButtonPanel: true,
                showTimepicker: true
            });
        </script>

        <script type="text/javascript" src="<?php echo base_url('js/hoverIntent.js') ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('js/superfish.js') ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('js/supersubs.js') ?>"></script> 
        <script>  
            $(document).ready(function() { 
                $('ul.sf-menu').supersubs({ 
                    minWidth:    12,   // minimum width of sub-menus in em units 
                    maxWidth:    27,   // maximum width of sub-menus in em units 
                    extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                    // due to slight rounding differences and font-family 
                }).superfish(); 
                
                $('input[type=text],textarea').live('keyup',function() {
                    $(this).val($(this).val().toUpperCase());
                });
            }); 

        </script>
        <script type="text/javascript">
            var $base_url = '<?php echo base_url() ?>';
            var $site_url = '<?php echo site_url() ?>';
            var $images_url = $base_url + '/images/';
            var $js_url = $base_url + '/js/';
            var $css_url = $base_url + '/css/';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/stmenu.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/swap.js') ?>"></script>
    </head>

    <body onLoad="MM_preloadImages('<?php echo base_url('images/pass_on.png') ?>','<?php echo base_url('images/logout_on.png') ?>','<?php echo base_url('images/delg_on.png') ?>')">
        <table class="table_main_container" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="table_band">
                    <table class="table_band_container" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="txt_logged">Anda Masuk Sebagai : <span class="txt_orange"><?php echo $this->session->userdata("nama_jabatan") . " [" .$this->session->userdata("nama_kantor"). "]"; ?></span></td>
                            <td class="txt_date"><?php echo date("l, d F Y")?></td>
                            <td class="tools_container">
                                <div class="tools_item"><a href="<?php echo base_url() . "index.php/adm/app/logout"; ?>"><img src="<?php echo base_url('images/logout.png') ?>" alt="Keluar Aplikasi" name="logout" width="20" height="18" border="0" id="logout" onMouseOver="MM_swapImage('logout','','<?php echo base_url('images/logout_on.png') ?>',1)" onMouseOut="MM_swapImgRestore()"></a></div>
                                <div class="tools_item"><a href="#"><img src="<?php echo base_url('images/pass.png') ?>" alt="Rubah Password" name="chg_pass" width="20" height="18" border="0" id="chg_pass" onMouseOver="MM_swapImage('chg_pass','','<?php echo base_url('images/pass_on.png') ?>',1)" onMouseOut="MM_swapImgRestore()"></a></div>
                                <div class="tools_item"><a href="#"><img src="<?php echo base_url('images/delg.png') ?>" alt="Pendelegasian User" name="delg" width="20" height="18" border="0" id="delg" onMouseOver="MM_swapImage('delg','','<?php echo base_url('images/delg_on.png') ?>',1)" onMouseOut="MM_swapImgRestore()"></a></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_header">
                    <div class="iproc_logo">&nbsp;</div>
                    <div class="j_logo"><div class="j_logo_l">&nbsp;</div></div>
                </td>
            </tr>
            <tr>
                <td class="table_menu_container">
                    <div class="menu_bg">
                        <div class="menu_l">&nbsp;</div>
                        <div class="menu_r">&nbsp;</div>
                        <div class="menu_c">
                            <div class="mn_item_container">
                                <!--<script type="text/javascript" src="<?php echo base_url('js/menu.js') ?>"></script>-->
								 <!--
                                <ul class="sf-menu">
                                    <li><a href="#">Home</a>

                                    </li>
                                    <li><a href="#">Procurement Management</a>
                                        <ul>
                                            <li><a href="">Daftar Pekerjaan</a></li>
                                            <li><a href="">Perencanaan Pengadaan</a>
												<ul>
													<li><a href="">Pembuatan Perencanaan Pengadaan</a>
													<li><a href="">Daftar Perencanaan Pengadaan</a>
													<li><a href="">Rekapitulasi Perencanaan Pengadaan</a>
													<li><a href="">Daftar Perencanaan Pengadaan Swakelola</a>
													<li><a href="">Update Daftar Perencanaan</a>
													
												</ul>
											</li>
											<li><a href="">Proses Pengadaan</a>
											<ul>
													<li><a href="">Pembuatan Permintaan Pengadaan</a>
													<li><a href="">Daftar Permintaan Pengadaan</a>
												 
													
												</ul>
											</li>
											<li><a href="">Procurement Tools</a>
											<ul>
													<li><a href="">Pembuatan Template Evaluasi Pengadaan</a>
													<li><a href="">Daftar Template Evaluasi Pengadaan</a>
													<li><a href="">Pembatalan Pengadaan</a>
													<li><a href="">Update Tanggal Pembukaan Penawaran</a>
													<li><a href="">Update Lampiran Dokument Pengadaan</a>
													<li><a href="">Update Data HPS</a>
													<li><a href="">Monitor Pengadaan</a>
												</ul>
											
											</li>
											<li><a href="">Report</a>
											<ul>
													<li><a href="">Laporan Pengadaan</a>
													<li><a href="">Laporan Rekapitulasi Perencanaan</a>
													<li><a href="">Laporan Kinerja Pengadaan</a>
													<li><a href="">Rekapitulasi Pengadaan</a>
													<li><a href="">Kinerja Pengadaan Per Divisi / Biro</a>
													<li><a href="">Kinerja Pengadaan Per Pelaksana</a>
													<li><a href="">Laporan Status Pengadaan</a>
													<li><a href="">Cetak Laporan Pelaksana Pengadaan</a>
													
												</ul>
											
											</li>
											<li><a href="">Panduan</a></li>  
                                        </ul>
                                    </li>
									<li><a href="#">Commodity Management</a>
                                        <ul>
                                            <li><a href="<?php echo base_url(); ?>index.php/pekerjaan_kom">Daftar Pekerjaan</a></li>
											<li><a href="">Data Referensi</a>
											<ul>
												<li><a href="<?php echo base_url(); ?>index.php/sumber_harga">Sumber</a>
											</ul>
											</li>
											<li><a href="">Katalog</a>
											<ul>
												<li><a href="<?php echo base_url(); ?>index.php/crud/gridr/ms_barang">Katalog Barang</a>
												<li><a href="<?php echo base_url(); ?>index.php/crud/gridr/ms_subkelompok_barang">Grup Barang</a>
												<li><a href="<?php echo base_url(); ?>index.php/jasa">Katalog Jasa</a>
												<li><a href="<?php echo base_url(); ?>index.php/kel_jasa">Grup Jasa</a>
											</ul>
											</li>
											<li><a href="">Daftar Harga</a>
											<ul>
												<li><a href="<?php echo base_url(); ?>index.php/harga_barang">Daftar Harga Barang</a>
												<li><a href="<?php echo base_url(); ?>index.php/harga_jasa">Daftar Harga Jasa</a>
											</ul>
											</li>
											<li><a href="">Panduan</a>
											<ul>
												<li><a href="">Pendahuluan</a>
												<li><a href="">Fitur Aplikasi</a>
												<li><a href="">Panduan Commodity Management</a>
												
											</ul>
											</li>	
                                        </ul>
                                    </li>
									
                                    <li><a href="#">Contract Management</a>
                                        <ul>
                                            <li><a href="">Daftar Pekerjaan</a></li>
											<li><a href="">Membuat Work Order</a></li>
											<li><a href="">Monitor</a>
											<ul>
												<li><a href="">Monitor Kontrak</a></li>
												<li><a href="">Monitor Work Order</a></li>
												<li><a href="">Monitor Progress Work Order</a></li>
												<li><a href="">Monitor Progress Milestone</a></li>
												<li><a href="">Monitor Progress Termin Pembayaran</a></li>
												<li><a href="">Monitor Adendum Kontrak</a></li>
												<li><a href="">Monitor Tagihan</a></li>
												
												
											</ul>
											</li>
											<li><a href="">Panduan</a>
											<ul>
												<li><a href="">Pendahuluan</a></li>
												<li><a href="">Fitur Aplikasi</a></li>
												<li><a href="">Manual Contract Management</a></li>
											</ul>
											</li>
											
											
                                             
                                        </ul>
                                    </li>
                                    <li><a href="#">Vendor Management</a>
                                        <ul>
                                            <li><a href="">Daftar Pekerjaan</a></li>
                                            <li><a href="">Vendor Tools</a> 
											<ul>
												<li><a href="">Aktivasi Vendor</a></li>
												<li><a href="">Monitor Vendor</a></li>
												<li><a href="">Update Vendor No</a></li>
											</ul>
											</li>
											<li><a href="">Daftar  Vendor</a>
											<ul>
												<li><a href="">Daftar Seluruh Vendor</a></li>
												<li><a href="">Generate Bidder List</a></li>
                                            </ul>
											</li>
											<li><a href="">Kinerja  Vendor</a>
											<ul>
												<li><a href="">Daftar Kinerja Vendor</a></li>
												<li><a href="">Aktivasi Suspend Vendor - Keseluruhan </a></li>
												<li><a href="">Suspend Vendor - Keseluruhan </a></li>
												<li><a href="">Suspend Vendor - Per Komoditi </a></li>
												<li><a href="">Aktivasi Suspend Vendor - Per Komoditi </a></li>
												<li><a href="">Black List Vendor</a></li>
												
											
											</ul>
											</li>
											<li><a href="">Report</a>
											<ul>
													<li><a href="">Dashboard Vendor</a></li>
													<li><a href="">Summary Vendor Berdasarkan Komomdity</a></li>
													
											
											</ul>
											</li>
											<li><a href="">Panduan</a>
											<ul>
													<li><a href="">Pendahuluan</a></li>
													<li><a href="">Fitur Aplikasi</a></li>
													<li><a href="">Petunjuk Penggunaaan Reg. Vendor</a></li>
													<li><a href="">Petunjuk Penggunaaan Vendor Management</a></li>
													<li><a href="">Petunjuk Kinerja Vendor</a></li>
													
											</ul>
											</li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Administration</a>
                                        <ul>
										   	
											<li><a href="">Master Data</a>
											<ul>
											 
												<li><a href="<?php echo base_url(); ?>index.php/kantor">Daftar Kantor</a>
												<li><a href="<?php echo base_url(); ?>index.php/matauang">Currency</a>
										 	
										 		<li><a href="<?php echo base_url(); ?>index.php/menu">Menu Management</a>
												<li><a href="<?php echo base_url(); ?>index.php/anggaran">Mata Anggaran</a>
												
												
											</ul>
											
											</li>
											<li><a href="">Admin Tools</a>
											<ul>
												<li><a href="<?php echo base_url(); ?>index.php/hirarki_jabatan">Hierarcy Position</a>
												<li><a href="<?php echo base_url(); ?>index.php/jabatan">Position</a>
												<li><a href="<?php echo base_url(); ?>index.php/panitia">Panitia Lelang/Ad Hoc</a>
												<li><a href="<?php echo base_url(); ?>index.php/kurs">Exchange Rate</a>
												
												
											</ul>
											</li> 
											<li><a href="">Panduan</a>
											<ul>
												<li><a href="">Pendahuluan</a>
												<li><a href="">Fitur Aplikasi</a>
												<li><a href="">Manual Guide Eproc</a>
												
											</ul>
											</li> 
											</li> 
                                             
                                        </ul>                                        
                                    </li>
                                </ul>
								 -->
							  
								<?php echo $menu; ?>
							 
								</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table_content_container">
                    <table class="table_content" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="brcrumbs_link">Anda berada di sini : <span class="txt_blue">Home</span></td>
                        </tr>
                        <tr>
                            <td class="table_of_contents"  >
								<table border="0" cellpadding="0" cellspacing="0" style="width: 97%">
                                    <tr>
                                        <td valign="top" style="height: 100%">

										
                                <div id="error-box" class="ui-state-error ui-corner-all" style="padding: 0 .7em;margin-bottom: 0.7em;display:none;"> 
                                    <p>
                                        <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
                                        <strong>ERROR</strong>
                                    </p>
                                </div>
								
					 
								
                                <?php echo $content_for_layout ?>

										</td>
									 </tr>	
								</table>	 
                               
                            </td>
                        </tr>
                        <tr>
                            <td class="table_iproc_logo">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_ornament">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="table_orn_purple"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_green"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_orange"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_blue"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_yl_green"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_footer">© 2012 Copyright <b>ADW Consulting</b> - All Right Reserved</td>
            </tr>
            <tr>
                <td class="table_end">&nbsp;</td>
            </tr>
        </table>
    </body>
</html>
<script>
    $(function() {
        $( "input:submit, input:button").button();
        $( ".datepicker" ).datepicker();
        $( ".datetimepicker" ).datetimepicker();
    });
</script>
