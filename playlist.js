document.addEventListener("DOMContentLoaded", () => {
    const playlist = document.getElementById("playlist");
    const recentSongs = document.getElementById("recent-songs");
    const form = document.getElementById("add-song-form");

    // Agregar canción a la playlist
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const title = document.getElementById("song-title").value;
        const artist = document.getElementById("song-artist").value;

        const songItem = document.createElement("li");
        songItem.textContent = `${title} - ${artist}`;
        playlist.appendChild(songItem);

        // Agregar a la lista de canciones recientes
        addRecentSong(title, artist);

        // Limpiar formulario
        form.reset();
    });

    // Agregar canción a recientes
    function addRecentSong(title, artist) {
        const recentItem = document.createElement("li");
        recentItem.textContent = `${title} - ${artist}`;
        if (recentSongs.children.length >= 5) {
            recentSongs.removeChild(recentSongs.firstChild);
        }
        recentSongs.appendChild(recentItem);
    }
});
