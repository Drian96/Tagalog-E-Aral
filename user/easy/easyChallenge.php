<?php include('head.php') ?>

<body>

    <header>
        <div class="mini-title">
            <a href="easyMain.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>

    <div class="main-container">

        <div class="easy-container">
            <div class="explore">
                <a href="easyQuiz.php">
                    <img src="../../image/easy.jpg" alt="Explore Image" class="explore-image">
                    <button class="explore-button">Easy Daily Quiz</button>
                </a>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <img src="../../image/average-locked.png" alt="Explore Image" class="colors-image">
                <button class="colors-button">Average Daily Quiz</button>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <img src="../../image/hard-locked.png" alt="Explore Image" class="animals-image">
                <button class="animals-button">Hard Daily Quiz</button>
            </div>
        </div>

    </div>

    <!-- Pop-up elements -->
        <div class="popup-overlay" id="popupOverlay"></div>
        <div class="popup" id="popupMessage">
            <p>Get a good score in assessment to unlock this</p>
        </div>

    <script>
        // Select all explore-container elements
        const exploreContainers = document.querySelectorAll('.explore-container');
        const popupOverlay = document.getElementById('popupOverlay');
        const popupMessage = document.getElementById('popupMessage');

        // Show the pop-up for any explore-container clicked
        exploreContainers.forEach((container) => {
            container.addEventListener('click', () => {
                popupOverlay.style.display = 'block';
                popupMessage.style.display = 'block';
            });
        });

        // Hide the pop-up when clicking anywhere, including the pop-up itself
        const hidePopup = () => {
            popupOverlay.style.display = 'none';
            popupMessage.style.display = 'none';
        };

        popupOverlay.addEventListener('click', hidePopup);
        popupMessage.addEventListener('click', hidePopup);
    </script>


</body>
</html>