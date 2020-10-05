<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->

    <title><?= $judul; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">
    <!-- Custom styles for this template -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">PAYROLL SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item mr-2">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= session()->get('nama_karyawan'); ?> <i class="fas fa-cog"></i>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item text-primary" href="/profil">Ubah Password</a>
                            <a class="dropdown-item text-primary" href="profil/ubahFoto">Ubah Foto</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="/auth/logout" tabindex="-1" aria-disabled="true">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex" id="wrapper">
                <div class="sidebar">
                    <ul class="nav nav-sidebar">
                        <li><img src="/img/<?= session()->get('foto'); ?>" class="rounded-circle" width="180" height="120"></a></li>
                        <li>

                        </li>
                    </ul>
                    <ul class="nav nav-sidebar list-group">
                        <?php if (session()->get('pekerjaan') == 'Admin') : ?>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(1) == 'karyawan' ? 'active' : ''; ?>"><a href="/karyawan"><i class="fas fa-desktop"></i>Data Karyawan <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(1) == 'pekerjaan' ? 'active' : ''; ?>"><a href="/pekerjaan"><i class="fas fa-table"></i>Data
                                    Pekerjaan</a>
                            </li>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(1) == 'gaji' ? 'active' : ''; ?>"><a href="/gaji"><i class="fas fa-sliders-h"></i>Data Gaji</a></li>
                            <li class="list-group-item list-group-item-action"><a href="#"><i class="fas fa-th"></i>Export</a></li>
                        <?php elseif (session()->get('pekerjaan') == 'Manager') : ?>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(1) == 'manager' ? 'active' : ''; ?>"><a href="\manager"><i class="fas fa-desktop"></i>Laporan Gaji <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(2) == 'lemburKaryawan' ? 'active' : ''; ?>"><a href="/lembur/lemburKaryawan"><i class="fas fa-th"></i>Lembur Karyawan</a>
                            </li>
                        <?php else : ?>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(1) == 'user' ? 'active' : ''; ?>"><a href="/user"><i class="fas fa-desktop"></i>Data Gaji<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="list-group-item list-group-item-action <?php $request = \Config\Services::request() ?><?= $request->uri->getSegment(1) == 'lembur' ? 'active' : ''; ?>"><a href="/lembur"><i class="fas fa-desktop"></i>Data Lembur<span class="sr-only">(current)</span></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?= $this->renderSection('content'); ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
        function previewImg() {
            const foto = document.querySelector('#foto');
            // const fotoLabel = document.querySelector('.costum-file-label');
            const fotoLabel = document.getElementsByClassName('custom-file-label');
            const tulisLabel = document.getElementById('p').innerHTML;
            const imgPreview = document.querySelector('.img-preview');
            //console.log(tulisLabel);
            fotoLabel.textContent = foto.files[0].name;
            document.getElementById('p').innerHTML = fotoLabel.textContent;
            const filefoto = new FileReader();
            filefoto.readAsDataURL(foto.files[0]);

            filefoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        // $("ul > li").hover(
        //     function() {
        //         $(this).addClass('active');
        //     }, function() {
        //         $( this ).removeClass('active');
        //     }
        // );
        $(document).ready(function() {
            $('ul li').click(function() {
                $('li').removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>


</html>