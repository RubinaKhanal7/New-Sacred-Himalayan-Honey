@extends('layouts2.superadmin')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <form id="quickForm" method="POST" action="{{ route('backend.sitesettings.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label for="office_name">Office Name</label>
                    <input type="text" name="office_name" class="form-control" placeholder="Office Name" id="office_name">
                </div>

                <div class="form-group" id="office_addresses_container">
                    <label for="office_address">Office Address</label>
                    <div class="input-group mb-3">
                        <input type="text" name="office_address[]" class="form-control" placeholder="Address">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary add-address" type="button">+</button>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="office_contacts_container">
                    <label for="office_contact">Office Contact</label>
                    <div class="input-group mb-3">
                        <input type="text" name="office_contact[]" class="form-control" placeholder="Office Contact">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary add-contact" type="button">+</button>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="office_emails_container">
                    <label for="office_email">Office Email</label>
                    <div class="input-group mb-3">
                        <input type="email" name="office_email[]" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary add-email" type="button">+</button>
                        </div>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="whatsapp_number">Whatsapp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" placeholder="Whatsapp Number" id="whatsapp_number">
                </div>

                <div class="form-group">
                    <label for="main_logo">Main Logo</label>
                    <input type="file" name="main_logo" class="form-control" id="main_logo" onchange="previewImage(this, 'main_logo_preview')">
                    <img id="main_logo_preview" src="#" alt="Main Logo Preview" style="display: none; max-width: 200px; margin-top: 10px;">
                </div>

                <div class="form-group">
                    <label for="side_logo">Side Logo</label>
                    <input type="file" name="side_logo" class="form-control" id="side_logo" onchange="previewImage(this, 'side_logo_preview')">
                    <img id="side_logo_preview" src="#" alt="Side Logo Preview" style="display: none; max-width: 200px; margin-top: 10px;">
                </div>

                <div class="form-group">
                    <label for="slogan">Slogan</label>
                    <input type="text" name="slogan" class="form-control" placeholder="Slogan" id="slogan">
                </div>

                <div class="form-group">
                    <label for="company_registered_date">Company Registered Date</label>
                    <input type="date" name="company_registered_date" class="form-control" id="company_registered_date">
                </div>

                <div class="form-group">
                    <label for="facebook_link">Facebook URL</label>
                    <input type="url" name="facebook_link" class="form-control" placeholder="Facebook URL (https://)" id="facebook_link">
                </div>

                <div class="form-group">
                    <label for="instagram_link">Insta URL</label>
                    <input type="url" name="instagram_link" class="form-control" placeholder="Insta URL (https://)" id="instagram_link">
                </div>

                <div class="form-group">
                    <label for="snapchat_link">Snapchat URL</label>
                    <input type="url" name="snapchat_link" class="form-control" placeholder="Snapchat URL (https://)" id="snapchat_link">
                </div>

                <div class="form-group">
                    <label for="linkedin_link">Linkedin URL</label>
                    <input type="url" name="linkedin_link" class="form-control" placeholder="LinkedIn URL (https://)" id="linkedin_link">
                </div>

                <div class="form-group">
                    <label for="google_maps_link">Google Maps</label>
                    <input type="url" name="google_maps_link" class="form-control" placeholder="Google Maps URL (https://)" id="google_maps_link">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>

    <!-- JavaScript for Image Preview and Dynamic Fields -->
    <script>
        function previewImage(input, imgId) {
            var imgElement = document.getElementById(imgId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgElement.src = e.target.result;
                    imgElement.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                imgElement.src = '#';
                imgElement.style.display = 'none';
            }
        }

        $(document).ready(function() {
            // Add new address input field
            $(".add-address").click(function() {
                $("#office_addresses_container").append('<div class="input-group mb-3">' +
                    '<input type="text" name="office_address[]" class="form-control" placeholder="Address">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-secondary remove-address" type="button">-</button>' +
                    '</div>' +
                    '</div>');
            });

            // Remove address input field
            $(document).on("click", ".remove-address", function() {
                $(this).parents(".input-group").remove();
            });

            // Add new contact input field
            $(".add-contact").click(function() {
                $("#office_contacts_container").append('<div class="input-group mb-3">' +
                    '<input type="text" name="office_contact[]" class="form-control" placeholder="Office Contact">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-secondary remove-contact" type="button">-</button>' +
                    '</div>' +
                    '</div>');
            });

            // Remove contact input field
            $(document).on("click", ".remove-contact", function() {
                $(this).parents(".input-group").remove();
            });

            // Add new email input field
            $(".add-email").click(function() {
                $("#office_emails_container").append('<div class="input-group mb-3">' +
                    '<input type="text" name="office_email[]" class="form-control" placeholder="Office Email">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-secondary remove-email" type="button">-</button>' +
                    '<button class="btn btn-outline-secondary add-email" type="button">+</button>' +
                    '</div>' +
                    '</div>');
            });

            // Remove email input field
            $(document).on("click", ".remove-email", function() {
                $(this).parents(".input-group").remove();
            });
        });
    </script>
@stop
