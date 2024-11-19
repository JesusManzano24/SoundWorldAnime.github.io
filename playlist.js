document.addEventListener("DOMContentLoaded", () => {
    const playlistId = 1; // Cambia según tu lógica para seleccionar playlists.

    // Cargar canciones
    fetch(`getSongs.php?playlist_id=${playlistId}`)
        .then(response => response.json())
        .then(data => {
            const playlistElement = document.getElementById("playlist");
            playlistElement.innerHTML = ""; // Limpia la lista
            data.forEach(song => {
                const li = document.createElement("li");
                li.textContent = `${song.title} - ${song.artist || "Artista desconocido"}`;
                playlistElement.appendChild(li);
            });
        })
        .catch(error => console.error("Error al cargar las canciones:", error));

    // Agregar canción
    document.getElementById("add-song-form").addEventListener("submit", function (e) {
        e.preventDefault();
        const title = document.getElementById("song-title").value;
        const artist = document.getElementById("song-artist").value;

        fetch("addSong.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `title=${encodeURIComponent(title)}&artist=${encodeURIComponent(artist)}&playlist_id=${playlistId}`,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Recargar la página
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error al añadir la canción:", error));
    });
});
