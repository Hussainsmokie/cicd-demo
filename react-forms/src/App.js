import { useState } from "react";
import "./App.css"; 

const App = () => {
  const [name, setName] = useState('');
  const [mobile, setMobile] = useState('');
  const [email, setEmail] = useState('');
  const [age, setAge] = useState('');
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    const email_validation = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const mobile_validation = /^[0-9]{10}$/;
    const age_validation = /^(?:[1-9][0-9]?)$/;

    if (!name || !mobile || !email || !age) {
      setError("Please fill in all the details");
      return;
    }

    if (!email_validation.test(email)) {
      setError("Invalid email format");
      return;
    }
    if (!mobile_validation.test(mobile)) {
      setError("Mobile number must be 10 digits");
      return;
    }
    if (!age_validation.test(age)) {
      setError("Age must be between 1 and 99");
      return;
    }
    
    const requestOptions = {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, email, mobile, age }),
    };

    try {
      const response = await fetch("http://myblogsite.in/design/portal/api/store", requestOptions);
      const data = await response.json();
      console.log("Success:", data);
      setSuccess("Form submitted successfully!");
      setError('');
      setName('');
      setMobile('');
      setEmail('');
      setAge('');
    } catch (error) {
      console.error("Error:", error);
      setError("Something went wrong. Please try again.");
    }
  };

  return (
    <div className="container">
      <form className="form" onSubmit={handleSubmit}>
        <h2>Registration Form</h2>

        <label htmlFor="name">Name:</label>
        <input name="name" type="text" value={name} onChange={(e) => setName(e.target.value)} placeholder="Enter your name" />

        <label htmlFor="mobile">Mobile:</label>
        <input name="mobile" type="number" value={mobile} onChange={(e) => setMobile(e.target.value)} placeholder="Enter your mobile" />

        <label htmlFor="email">Email:</label>
        <input name="email" type="text" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="Enter your email" />

        <label htmlFor="age">Age:</label>
        <input name="age" type="number" value={age} onChange={(e) => setAge(e.target.value)} placeholder="Enter your age" />

        <button type="submit">Submit</button>

        {error && <p className="error">{error}</p>}
        {success && <p className="success">{success}</p>}
      </form>
    </div>
  );
};

export default App;
