<?= $this->extend('Auth/Template/index'); ?>

<?= $this->section('content'); ?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row" style="background: #1c4645;">
                    <div class="col-lg-6"><img class="img-thumbnail" src="<?= base_url('img/tengiri.jpeg') ; ?>" alt="" srcset=""></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Admin Stock</h1>
                            </div>
                            <form class="user" action="<?= base_url('login_') ; ?>" method="Post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"
                                        id="username" name="username" aria-describedby="emailHelp"
                                        placeholder="Masukan username anda ...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="password" name="password" placeholder="Masukan password anda ...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                <hr>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

<?= $this->endSection(); ?>