<?php if ($this->session->flashdata('success')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Success',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Ops! Something Wrong',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('successLogin')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Success Login',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('errorLogin')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Ops! Something Wrong',
            text: 'Username or Password is Incorrect',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('successEdit')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Success',
            text: 'Edit Data Success',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('successInput')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Success Add New Data',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('successRegist')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Registration Success',
            text: 'Please wait before approved',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('successDelete')) : ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Success Delete',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>