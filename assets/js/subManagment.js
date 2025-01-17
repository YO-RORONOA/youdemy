document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-student').forEach(button => {
                button.addEventListener('click', async function() {
                    if (!confirm('Are you sure you want to remove this student from the course?')) {
                        return;
                    }

                    const studentId = this.dataset.studentId;
                    const courseId = this.dataset.courseId;
                    const row = document.getElementById(`student-row-${studentId}`);

                    try {
                        const response = await fetch('../../controllers/teachercontroller/enrollmentManagmentController.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `student_id=${studentId}&course_id=${courseId}`
                        });

                        const data = await response.json();
                        console.log(data);
                        
                        if (data.success) {
                            row.remove();
                            if (document.querySelectorAll('tbody tr').length === 0) {
                                location.reload(); // Reload to show "no students" message
                            }
                        } else {
                            alert('Failed to remove student. Please try again.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });