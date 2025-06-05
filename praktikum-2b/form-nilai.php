<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Registrasi IT Club Data Science</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<?php
require_once "form-nilai.php";
?>

<form>
  <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Nama Lengkap</label> 
    <div class="col-8">
      <input id="nama" name="nama" placeholder="*Santosa" type="text" required="required" size= "30" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="Mata Kuliah" class="col-4 col-form-label">Mata Kuliah</label> 
    <div class="col-8">
      <select id="Mata Kuliah" name="Mata Kuliah" class="custom-select" required="required">
        <option value="DDP">Dasar Dasar Pemrograman</option>
        <option value="WEB1">Pemrograman Web</option>
        <option value="BDI">Basis Data</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-4 col-form-label">Nilai UTS</label> 
    <div class="col-8">
      <input id="" name="" placeholder="*90" type="text" required="required" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-4 col-form-label">Nilai UAS</label> 
    <div class="col-8">
      <input id="" name="" placeholder="*90" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-4 col-form-label">Nilai Tugas / Praktikum</label> 
    <div class="col-8">
      <input id="" name="" placeholder="*90" type="text" class="form-control" required="required">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<?php
$proses = $_GET["proses"];
$nama_siswa = $_GET["nama"];
$mata_kuliah = $_GET["matkul"];
$nilai_uts = $_GET["nilai_uts"];
$nilai_uas = $_GET["nilai_uas"];
$nilai_tugas = $_GET["nilai_tugas"];

echo "Proses : ".$proses;
echo "<br/>Nama : ".$nama_siswa;
echo "<br/>Mata Kuliah : ".$Mata_Kuliah;
echo "<br/>Nilai uts : ".$Nilai_UTS;
echo "<br/>Nilai uas : ".$Nilai_UAS;
echo "<br/>Nilai tugas : ".$Nilai_Tugas;
