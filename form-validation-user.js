$(function() {
    $("form[name='registracija']").validate({

      rules: {

        ime: {
          required: true,
      },
      prezime: {
        required: true,
    },
    username:{
        required:true,

    },

        pass: {
          required: true,

          
        },
        pass1:{
          required: true,
          equalTo: "#pass",
        }
      },
      messages: {
        ime: {
          required: "Potrebno je upisati ime",

        },
        prezime: {
            required: "Potrebno je upisati prezime",
  
          },
          username: {
            required: "Potrebno je upisati korisnicko ime",
  
          },
          pass: {
            required: "Potrebno je upisati lozinku",
          },
        pass1: {
          required: "Potrebno je ponoviti lozinku",
          equalTo: "Lozinke trebaju biti iste"
        },
     },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });