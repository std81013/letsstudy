window.onload = function() {
    flatpickr(".anotherSelector", {});
    flatpickr("#activityDateInput", {
        mode: "range",
        enableTime: true,
        minDate: "today",
        minTime: "00:00",
        dateFormat: "Y-m-d H:i"
    });
};