const validation = new JustValidate("#usersignup");

validation
    .addField("#firstname", [{ rule: "required" }])
    .addField("#lastname", [{ rule: "required" }])
    .addField("#email", [
        { rule: "required" },
        { rule: "email" },
        {
            validator: async (value) => {
                const response = await fetch("validate-email.php?email=" + encodeURIComponent(value));
                const json = await response.json();
                return json.available;
            },
            errorMessage: "Email is already taken"
        }
    ])
    .addField("#password", [{ rule: "required" }, { rule: "password" }])
    .addField("#confirmpassword", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ]);

const form = document.getElementById("usersignup");

form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    validation.validate().then(isValid => {
        if (isValid) {
            document.getElementById("usersignup").submit(); // Submit the form if validation passes
        }
    });
});
