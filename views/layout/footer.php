<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    AOS.init({
        duration: 900,
        once: true
    });

    if (document.querySelector(".datatable")) {
        new DataTable(".datatable");
    }

    document.querySelectorAll(".btn-hapus").forEach(function (button) {

        button.addEventListener("click", function (e) {

            e.preventDefault();

            let url = this.href;

            Swal.fire({
                title: "Hapus Data?",
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc2626",
                cancelButtonColor: "#2563eb",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {

                if (result.isConfirmed) {
                    window.location = url;
                }

            });

        });

    });

    applyTheme();

});

function applyTheme() {

    let theme = localStorage.getItem("portoTheme");

    if (!theme) {
        theme = "blue";
        localStorage.setItem("portoTheme", "blue");
    }

    document.body.classList.remove(
        "theme-blue",
        "theme-dark",
        "theme-purple",
        "theme-emerald",
        "theme-orange"
    );

    document.body.classList.add("theme-" + theme);

}

function setTheme(theme) {

    localStorage.setItem("portoTheme", theme);

    applyTheme();

    Swal.fire({
        icon: "success",
        title: "Tema berhasil diubah",
        text: "Sekarang menggunakan tema " + theme,
        timer: 1500,
        showConfirmButton: false
    });

}


</script>

</body>
</html>