function showSection(event, sectionId) {
    event.preventDefault();
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');

    document.querySelectorAll('#sidebar li').forEach(li => li.classList.remove('active'));
    document.querySelector(`#sidebar li a[href="#${sectionId}"]`).parentElement.classList.add('active');
}