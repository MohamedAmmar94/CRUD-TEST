@if(Session::has('success'))
    <script>
        Notiflix.Notify.Success('{{ Session::get('success') }}');

    </script>

@endif
@if(Session::has('error'))
    <script>
        Notiflix.Notify.Failure('{{ Session::get('error') }}');
    </script>
@endif
@if(Session::has('info'))
    <script>
        Notiflix.Notify.Info('{{ Session::get('info') }}');
    </script>
@endif
