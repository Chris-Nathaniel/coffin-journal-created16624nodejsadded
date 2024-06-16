<div class="music-player">
        <img src="images/myers.jpg" alt="Song Cover" id="cover" class="cover">
        <div class="info">
            <h3 id="title">Song Title</h3>
            <div class="progress-container">
                <input type="range" id="progress-bar" value="0" min="0" max="100">
                <div class="time">
                    <span id="current-time">0:00</span> <span id="duration">0:00</span>
                </div>
            </div>
            <div class="controls">
                <i class="fas fa-play" id="play"></i>
                <i class="fas fa-pause" id="pause" style="display: none;"></i>
                <i class="fas fa-stop" id="stop"></i>
            </div>
        </div>
    <audio id="audio" src="audio/1.mp3"></audio>
    </div>
</div>