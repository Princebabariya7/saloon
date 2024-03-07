<!DOCTYPE html>
<html lang="en">
@include('Frontend.layout.all_css')
<body>
@include('Frontend.layout.header')
@yield('mainContent')
@include('Frontend.layout.footer')
@include('Frontend.layout.all_js')
</body>
<script>
    $('#languageDropdown').change(function () {
        var selectedLanguage = $(this).val();
        console.log(selectedLanguage);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Your AJAX request here
        $.ajax({
            url: '{{route('online.setLocale')}}',
            type: 'POST',
            data: {locale: selectedLanguage},
            success: function (response) {
                // Refresh the page or update content based on the new locale
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error('Error updating language:', error);
                console.log(xhr.responseText);
            }

        });
    });
</script>
</html>
