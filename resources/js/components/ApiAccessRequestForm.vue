<template>
  <div>
    <h2>Request API Access</h2>
    <form @submit.prevent="submitRequest">
      <div>
        <label>First Name:</label>
        <input v-model="form.first_name" type="text" required />
      </div>
      <div>
        <label>Last Name:</label>
        <input v-model="form.last_name" type="text" required />
      </div>
      <div>
        <label>Company:</label>
        <input v-model="form.company" type="text" />
      </div>
      <div>
        <label>Email:</label>
        <input v-model="form.email" type="email" required />
      </div>
      <div>
        <label>City:</label>
        <input v-model="form.city" type="text" required />
      </div>
      <div>
        <label>Address:</label>
        <input v-model="form.address" type="text" required />
      </div>
      <button type="submit">Submit Request</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        first_name: '',
        last_name: '',
        company: '',
        email: '',
        city: '',
        address: ''
      }
    };
  },
  methods: {
    submitRequest() {
      console.log("Form Data: ", this.form); // Log form data
      console.log("Submitting to: /api-access-request"); // Log the endpoint being called

      axios.post('/api-access-request', this.form)
        .then(response => {
          console.log("Response: ", response); // Log successful response
          alert(response.data.message);
          this.form = {
            first_name: '',
            last_name: '',
            company: '',
            email: '',
            city: '',
            address: ''
          };
        })
        .catch(error => {
          console.error("Error: ", error.response); // Log the error response
          alert('An error occurred while submitting your request.');
        });
    }
  }
};
</script>
