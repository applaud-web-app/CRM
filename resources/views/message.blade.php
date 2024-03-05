
@if(Session::has('error'))
<script>
iziToast.error({
    title: 'Error',
    message: '{{Session::get("error")}}',
    position:'topRight'
});
</script>
@endif
@if(Session::has('success'))
<script>
iziToast.success({
    title: 'Success',
    message: '{{Session::get("success")}}',
    position:'topRight'
});
</script>
@endif

@if(Session::has('warning'))
<script>
iziToast.warning({
    title: 'Warning',
    message: '{{Session::get("success")}}',
    position:'topRight'
});
</script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{$error}}',
                position:'topRight'
            });
        </script>
    @endforeach
@endif