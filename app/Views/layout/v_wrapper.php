<?php
echo view('layout/v_head.php');
echo view('layout/v_navbar_header.php');
echo view('layout/v_menu.php');
echo view('layout/v_content.php');
echo view('layout/v_footer.php');

if ($isi == 'jabatan/v_jabatan') {
    echo view('jabatan/scriptJS');
    echo view('jabatan/function');
} else if ($isi == 'jenis/v_jenis') {
    echo view('jenis/scriptJS');
    echo view('jenis/function');
} else if ($isi == 'klasifikasi/v_klasifikasi') {
    echo view('klasifikasi/scriptJS');
    echo view('klasifikasi/function');
} else if ($isi == 'sifat/v_sifat') {
    echo view('sifat/scriptJS');
    echo view('sifat/function');
} else if ($isi == 'isiDispos/v_isiDispos') {
    echo view('isiDispos/scriptJS');
    echo view('isiDispos/function');
} else if ($isi == 'user/v_user') {
    echo view('user/scriptJS');
    echo view('user/function');
} else if ($isi == 'formIN/v_formIN') {
    echo view('formIN/scriptJS');
} else if ($isi == 'suratMasuk/v_suratMasuk') {
    echo view('suratMasuk/scriptJS');
    echo view('suratMasuk/function');
} else if ($isi == 'conApp/v_conApp') {
    echo view('conApp/scriptJS');
    echo view('conApp/function');
} else if ($isi == 'company/v_company') {
    echo view('company/scriptJS');
    echo view('company/function');
}
