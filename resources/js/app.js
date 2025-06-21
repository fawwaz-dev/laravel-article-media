import "./bootstrap";
import Swal from "sweetalert2";
import axios from "axios";

document.addEventListener("DOMContentLoaded", () => {
    // Toggle notification dropdown
    const notificationToggle = document.getElementById("notification-toggle");
    const notificationDropdown = document.getElementById(
        "notification-dropdown"
    );
    notificationToggle.addEventListener("click", () => {
        notificationDropdown.classList.toggle("hidden");
    });

    // Mark notification as read
    document.querySelectorAll(".mark-read").forEach((button) => {
        button.addEventListener("click", async (e) => {
            const notificationId = e.target.dataset.id;
            try {
                await axios.post(`/notifications/${notificationId}/read`, {
                    _token: window.Laravel.csrfToken,
                });
                e.target.closest("li").classList.remove("bg-blue-50");
                e.target.closest("li").classList.add("bg-gray-50");
                e.target.remove();
                updateBadge();
            } catch (error) {
                console.error("Gagal menandai notifikasi:", error);
            }
        });
    });

    // Mark all notifications as read
    document
        .getElementById("mark-all-read")
        .addEventListener("click", async () => {
            try {
                await axios.post("/notifications/read-all", {
                    _token: window.Laravel.csrfToken,
                });
                document
                    .querySelectorAll("#notification-list li")
                    .forEach((li) => {
                        li.classList.remove("bg-blue-50");
                        li.classList.add("bg-gray-50");
                        const button = li.querySelector(".mark-read");
                        if (button) button.remove();
                    });
                updateBadge();
            } catch (error) {
                console.error("Gagal menandai semua notifikasi:", error);
            }
        });

    // Update badge count
    function updateBadge() {
        const badge = notificationToggle.querySelector("span");
        const unreadCount = document.querySelectorAll(
            "#notification-list li.bg-blue-50"
        ).length;
        if (unreadCount > 0) {
            badge.textContent = unreadCount;
            badge.classList.remove("hidden");
        } else {
            badge.classList.add("hidden");
        }
    }

    // Real-time notifications
    if (window.Echo && window.Laravel.user) {
        const userId = window.Laravel.user.id;
        console.log("Menginisialisasi channel articles." + userId);
        const channel = window.Echo.private("articles." + userId);
        channel
            .subscribed(() => {
                console.log("Berhasil subscribe ke channel articles." + userId);
            })
            .listen(".App\\Events\\ArticlePublished", (e) => {
                console.log("Notifikasi diterima:", e);
                Swal.fire({
                    title: "Artikel Baru!",
                    text: e.message || "Notifikasi tanpa pesan",
                    icon: "success",
                });

                // Tambahkan notifikasi ke dropdown
                const notificationList =
                    document.getElementById("notification-list");
                const li = document.createElement("li");
                li.className = "p-4 bg-blue-50 hover:bg-gray-100";
                li.innerHTML = `
                <p class="text-sm">${e.message}</p>
                <p class="text-xs text-gray-500">Baru saja</p>
                <button class="text-xs text-blue-600 hover:underline mark-read" data-id="new">Tandai sebagai dibaca</button>
            `;
                notificationList.prepend(li);
                updateBadge();

                // Tambahkan event listener untuk tombol mark-read baru
                li.querySelector(".mark-read").addEventListener(
                    "click",
                    async (e) => {
                        try {
                            await axios.post("/notifications/new/read", {
                                _token: window.Laravel.csrfToken,
                                message: e.message,
                            });
                            li.classList.remove("bg-blue-50");
                            li.classList.add("bg-gray-50");
                            li.querySelector(".mark-read").remove();
                            updateBadge();
                        } catch (error) {
                            console.error("Gagal menandai notifikasi:", error);
                        }
                    }
                );
            })
            .error((error) => {
                console.error(
                    "Gagal subscribe ke channel articles." + userId + ":",
                    error
                );
            });

        window.Echo.connector.pusher.connection.bind("connected", () => {
            console.log("Terhubung ke Pusher");
        });
        window.Echo.connector.pusher.connection.bind("disconnected", () => {
            console.log("Terputus dari Pusher");
        });
    } else {
        console.error("Echo atau pengguna tidak terdefinisi");
    }
});
