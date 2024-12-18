document.addEventListener("DOMContentLoaded", () => {
    const steps = document.querySelectorAll(".step");
    const formSteps = document.querySelectorAll(".form-step");
    const progress = document.getElementById("progress");
    const nextBtns = document.querySelectorAll(".next-btn");
    const prevBtns = document.querySelectorAll(".prev-btn");

    let currentStep = 0;

    // Cập nhật giao diện thanh tiến trình
    function updateProgress() {
        steps.forEach((step, index) => {
            if (index <= currentStep) {
                step.classList.add("active");
            } else {
                step.classList.remove("active");
            }
        });

        const progressWidth = (currentStep / (steps.length - 1)) * 100;
        progress.style.width = `${progressWidth}%`;

        formSteps.forEach((formStep, index) => {
            formStep.classList.toggle("active", index === currentStep);
        });
    }

    // Sự kiện nút Tiếp theo
    nextBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                updateProgress();
            }
        });
    });

    // Sự kiện nút Quay lại
    prevBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                updateProgress();
            }
        });
    });

    // Gửi form (Tùy chỉnh hành động)
    // document
    //     .getElementById("multi-step-form")
    //     .addEventListener("submit", (e) => {
    //         e.preventDefault();
    //         alert("Form đã được gửi!");
    //     });

    updateProgress();
});
