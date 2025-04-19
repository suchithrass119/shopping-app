    <br>
        <br>
        <br>
    <footer>
        <p class="mb-0">© {{ date('Y') }} HELOIDE. All rights reserved. | Designed with 💚 for shoppers.</p>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.getElementById('successToast');
        if (toastElement) {
            const toast = new bootstrap.Toast(toastElement, {
                delay: 3000
            });
            toast.show();
        }
    });
    </script>
</body>

</html>