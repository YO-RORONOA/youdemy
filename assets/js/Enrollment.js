

document.getElementById('enrollButton').addEventListener('click', async function() {
    const button = this;
    const courseId = button.dataset.courseId;
    const isEnrolled = button.classList.contains('btn-danger');
    
    try {
        const response = await fetch('../../controllers/student/Enrollment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `course_id=${courseId}&action=${isEnrolled ? 'unenroll' : 'enroll'}`
        });
        
        const data = await response.json();
        
        if (data.success) {
            if (isEnrolled) {
                button.classList.replace('btn-danger', 'btn-primary');
                button.textContent = 'Subscribe to Course';
            } else {
                button.classList.replace('btn-primary', 'btn-danger');
                button.textContent = 'Unsubscribe from Course';
            }
        } else {
            alert('There was an error processing your request. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('There was an error processing your request. Please try again.');
    }
});



