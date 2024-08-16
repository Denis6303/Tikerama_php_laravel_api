<template>
  <div class="page-container">
    <div class="left-section">
      <h1>TIKERAMA API MANAGEMENT</h1>
      <p><strong>TIKERAMA</strong> TIKERAMA est une plateforme spécialisée dans la distribution d'API. Nous proposons une variété d'API pour différents besoins. Découvrez nos services et trouvez l'API adaptée à vos projets.</p>
      <p><a :href="apiDocumentationUrl" target="_blank">Voir la documentation de l'API</a></p>
      <div class="endpoints">
        <h2>API Endpoints</h2>
        <ul>
          <p>EVENEMENTS</p>
          <li><span>GET /api/v1/events</span> => Récupérer tous les évènements</li>
          <li><span>POST /api/v1/events</span> => Créer un nouvel évènement</li>
          <li><span>GET /api/v1/events/{event}</span> => Afficher un évènement</li>
          <li><span>PUT /api/v1/events/{event}</span> => Mettre à jour un èvènement</li>
          <li><span>DELETE /api/v1/events/{event}</span> => Supprimer un évènement</li>
          <p>TYPES DE TICKETS</p>
          <li><span>GET /api/v1/events/{event_id}/ticket-types</span> => Récupérer tous les types de tickets</li>
          <li><span>POST /api/v1/events/{event_id}/ticket-types</span> => Créer un nouveau type de ticket</li>
          <li><span>GET /api/v1/events/{event_id}/ticket-types/{ticket_type_id}</span> => Afficher un type de ticket</li>
          <li><span>PUT /api/v1/events/{event_id}/ticket-types/{ticket_type_id}</span> => Mettre à jour un type de ticket</li>
          <li><span>DELETE /api/v1/events/{event_id}/ticket-types/{ticket_type_id}</span> => Supprimer un type de ticket     </li>
          <p>INTENTIONS DE COMMANDE</p>
          <li><span>GET /api/v1/order-intents</span> => Récupérer les intentions de commande</li>
          <li><span>POST /api/v1/order-intents</span> => Créer une intention de commande</li>
          <li><span>GET /api/v1/order-intents/{order_intent}</span> => Afficher une intention de commande</li>
          <li><span>PUT /api/v1/order-intents/{order_intent}</span> => Mettre à jour une intentio de commande</li>
          <li><span>DELETE /api/v1/order-intents/{order_intent}</span> => Supprimer une intention de commande</li>
          <p>VALIDER UNE INTENTION DE COMMANDE</p>
          <li><span>POST /api/v1/order-intents/{id}/validate</span></li>
          <p>CONSULTER LES COMMANDES EFFECTUEES PAR UN CLIENT</p>
          <li><span>GET /api/v1/users/{user_id}/orders</span> => Récupérer les commandes liées à un client</li>
          <p>RECUPERER LES INTENTIONS DE COMMANDE D'UN CLIENT</p>
          <li><span>GET /api/v1/users/{user_id}/order-intents</span> => Récupérer les intentions de commandes d'un client</li>
          <p>DEMANDE D'ACCES a L'API</p>
          <li><span>POST /api-access-request</span> => Faire une requête d'accès aux API</li>
        </ul>
      </div>
    </div>
    <div class="right-section">
      <p>Veuillez remplir le formulaire ci-dessous pour demander l'accès à nos API :</p>
      <form @submit.prevent="submitRequest">
        <div class="form-group">
          <label for="first_name">Prénom :</label>
          <input v-model="form.first_name" type="text" id="first_name" required>
        </div>
        <div class="form-group">
          <label for="last_name">Nom :</label>
          <input v-model="form.last_name" type="text" id="last_name" required>
        </div>
        <div class="form-group">
          <label for="company">Service:</label>
          <input v-model="form.company" type="text" id="company" required>
        </div>
        <div class="form-group">
          <label for="email">Adresse Email:</label>
          <input v-model="form.email" type="email" id="email" required>
        </div>
        <div class="form-group">
          <label for="city">Ville:</label>
          <input v-model="form.city" type="text" id="city" required>
        </div>
        <div class="form-group">
          <label for="address">Adresse:</label>
          <input v-model="form.address" type="text" id="address" required>
        </div>
        <button type="submit" class="submit-btn">Envoyer La Requête</button>
      </form>
      <footer class="footer">
        &copy; TIKERAMA {{ new Date().getFullYear() }}
      </footer>
    </div>
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

<style scoped>
html, body {
  font-family: 'Century Gothic', 'Arial', sans-serif; /* Century Gothic, Arial comme alternative */
  margin: 0;
  padding: 0;
  height: 100%;
  overflow-x: hidden;
}

h1, h2, p, label, span, .footer, li {
  font-family: 'Century Gothic', 'Arial', sans-serif;
}

.page-container {
  display: flex;
  height: calc(100vh - 20px); /* Adjust height to fit within viewport minus footer height */
  margin: 0;
  overflow-x: hidden; 
}

.left-section, .right-section {
  margin: 0 10px;
}

.left-section {
  flex: 2; /* Deux fois plus grande que la droite */
  border-right: 1px solid #ddd;
  padding: 20px;
  overflow-y: auto;
  box-sizing: border-box;
}

.right-section {
  flex: 1; /* Taille normale */
  padding-right: 20px;
  padding-left: 0px;
  box-sizing: border-box;
}

h1 {
  color: #333;
}

h2 {
  color: #555;
}

p {
  color: #666;
}

a {
  color: #007bff;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

.endpoints ul {
  list-style-type: disc;
  padding-left: 20px;
}

.endpoints li {
  margin-bottom: 10px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 10px;
}

.submit-btn {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-btn:hover {
  background-color: #218838;
}

.footer {
  text-align: center;
  margin-top: 20px; /* Add some space above the footer */
}

li > span {
  color: #218838; /* Change la couleur du texte en vert */
  font-weight: bold; /* Optionnel : rend le texte en gras */
}
</style>