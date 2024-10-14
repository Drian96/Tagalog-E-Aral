

document.addEventListener('DOMContentLoaded', function() {
    const choiceButtons = document.querySelectorAll('.choices button');
    const resultPopup = document.getElementById('result-popup');
    const resultText = document.getElementById('result-text');
    const nextBtn = document.getElementById('next-btn');
    const audio = document.getElementById('audio');
    
    // Play audio on image click
    const imageClick = document.getElementById('image-click');
    imageClick.addEventListener('click', () => {
        audio.play();
    });

    choiceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userChoice = parseInt(this.getAttribute('data-choice'));
            
            // Compare user's choice with the correct choice
            if (userChoice === correctChoice) {
                resultText.textContent = "Correct!";
                
                // If the user hasn't already earned a star, update stars
                if (!earnedStar) {
                    updateStars(1, questionId).then(() => {
                        console.log("Star earned and updated!");
                    }).catch(error => {
                        console.error("Error updating stars:", error);
                    });
                }
            } else {
                resultText.textContent = "Wrong! Try again.";
            }

            // Show the result popup and the next button
            resultPopup.style.display = 'block';
            nextBtn.style.display = 'block'; // Show "Next Question" button
        });
    });

    // Load next question on button click
    nextBtn.addEventListener('click', function() {
        // Make an AJAX request to increment the current question in the session and reload
        $.ajax({
            url: 'next_question.php',
            method: 'POST',
            success: function() {
                console.log('Next question loaded successfully.');
                location.reload(); // Reload the page to load the next question
            },
            error: function(xhr, status, error) {
                console.error("Error loading next question:", error);
            }
        });
    });

    // Function to update stars in the database
    function updateStars(starsEarned, questionId) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'update_stars.php', // Ensure this PHP file handles updating the stars in the database
                method: 'POST',
                data: {
                    stars: starsEarned,
                    question_id: questionId,
                    user_id: userId
                },
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }
});
