<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multi-Step Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
  <div id="form-container" class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
    <!-- Step 1 -->
    <div id="step-1" class="step">
      <h2 class="text-xl font-bold mb-4">Step 1: Personal Info</h2>
      <input type="text" id="name" class="w-full p-2 border rounded mb-4" placeholder="Name" required>
      <input type="email" id="email" class="w-full p-2 border rounded mb-4" placeholder="Email" required>
      <button class="next bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Next</button>
    </div>
    <!-- Step 2 -->
    <div id="step-2" class="step hidden">
      <h2 class="text-xl font-bold mb-4">Step 2: Additional Info</h2>
      <textarea id="message" class="w-full p-2 border rounded mb-4" placeholder="Message"></textarea>
      <button class="prev bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</button>
      <button class="submit bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Submit</button>
    </div>
  </div>

  <script>
    // Multi-step logic
    const steps = document.querySelectorAll('.step');
    let currentStep = 0;

    document.querySelectorAll('.next').forEach(btn =>
      btn.addEventListener('click', () => {
        steps[currentStep].classList.add('hidden');
        steps[++currentStep].classList.remove('hidden');
      })
    );

    document.querySelectorAll('.prev').forEach(btn =>
      btn.addEventListener('click', () => {
        steps[currentStep].classList.add('hidden');
        steps[--currentStep].classList.remove('hidden');
      })
    );

    document.querySelector('.submit').addEventListener('click', () => {
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const message = document.getElementById('message').value;

      const formData = { name, email, message };
      fetch('/submit', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData),
      })
        .then(res => res.json())
        .then(data => alert('Form submitted!'))
        .catch(err => console.error(err));
    });
  </script>
</body>
</html>
