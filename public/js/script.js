document.addEventListener("DOMContentLoaded", () => {
    // Ambil semua elemen sidebar menu dengan class nav-link
    const sidebarLinks = document.querySelectorAll(".nav-sidebar .nav-link");

    // Ambil URL saat ini
    const currentUrl = window.location.href;

    sidebarLinks.forEach(link => {
        // Cek apakah href dari link cocok dengan URL saat ini
        if (link.href === currentUrl) {
            // Tambahkan class active pada elemen link
            link.classList.add("active");

            // Cari parent menu (dropdown) jika ada
            let parent = link.closest(".has-treeview");
            if (parent) {
                // Tambahkan class menu-open untuk membuka dropdown
                parent.classList.add("menu-open");

                // Tambahkan class active pada parent link
                const parentLink = parent.querySelector(".nav-link");
                if (parentLink) {
                    parentLink.classList.add("active");
                }
            }
        }
    });
});

// HAPUS
