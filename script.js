document.getElementById("feedbackForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("feedback.php", {
        method: "POST",
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json(); // Assuming feedback.php returns JSON
            } else {
                throw new Error("Network response was not ok");
            }
        })
        .then(data => {
            // Show success message
            document.getElementById("success").style.display = "block";

            // Prepend new feedback to the top of the list
            prependFeedback(data);

            // Clear form fields
            document.getElementById("feedbackForm").style.display = 'none';
        })
        .catch(error => {
            console.error("Error:", error);
            document.getElementById("error").style.display = "block";
        });

    // Helper function to prepend new feedback
    function prependFeedback(feedback) {
        let feedbackList = document.querySelector(".feedback-list");

        // Create new list item for feedback
        let li = document.createElement("li");
        li.className = "feedback-item";
        li.innerHTML = `
            <p><strong>${feedback.name}</strong> says:</p>
            <p>${feedback.message}</p>
        `;

        // Insert new feedback at the top of the list
        feedbackList.insertBefore(li, feedbackList.firstChild);
    }
});