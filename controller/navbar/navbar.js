document.addEventListener('DOMContentLoaded', function () {
    var dashboardLink = document.getElementById('dashboard-link');
    var dashboardDropdown = document.getElementById('dashboard-dropdown');

    dashboardLink.addEventListener('mouseenter', function () {
        dashboardDropdown.style.display = 'block';
        dashboardDropdown.style.opacity = 1;
    });

    dashboardLink.addEventListener('mouseleave', function () {
        dashboardDropdown.style.display = 'none';
        dashboardDropdown.style.opacity = 0;
    });

    dashboardDropdown.addEventListener('mouseenter', function () {
        dashboardDropdown.style.display = 'block';
        dashboardDropdown.style.opacity = 1;
    });

    dashboardDropdown.addEventListener('mouseleave', function () {
        dashboardDropdown.style.display = 'none';
        dashboardDropdown.style.opacity = 0;
    });
});