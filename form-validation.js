$(function() {
    $("form[name='unos']").validate({

      rules: {

        naslov: {
        required: true,
        maxlength: 30,
        minlength:5,
        
      },
        o: {
          required: true,
          maxlength: 100,
          minlength:10,
          
        },
        sadrzaj:{
          required: true,
          
        },
          slika: {
            required: true,
            extension: "jpg|jpeg|png|ico|bmp"
      },

},
      messages: {
        naslov: {
          required: "<br>Naslov nesmije biti prazan",
          maxlength: "<br>Naslov smije imati najviše 30 znakova",
          minlength: "<br>Naslov mora imati najmanje 5 znakova",
        },
        o:{
            required:"<br>Sadržaj nesmije biti prazan",
            maxlength: "<br>Sadržaj smije imati najviše 100 znakova",
            minlength: "<br>Sadržaj mora imati najmanje 10 znakova",

        },
        sadrzaj: {
          required: "<br>Mora postojati sadrzaj",
        },
        slika: {
            required: "<br>Potrebno je postaviti sliku",
            extension: "<br>Samo ovo su dopušteni formati: (jpg, jpeg, png, ico, bmp)."
          },
     },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });