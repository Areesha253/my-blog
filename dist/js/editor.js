document.addEventListener("DOMContentLoaded", () => {
  tinymce.init({
    selector: "#content",
    license_key: "gpl",
    menubar: false,
    plugins: "lists link image code",
    toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code",
    images_upload_url: "../includes/upload_image.php",
    promotion: false,
    branding: false,
    automatic_uploads: true,
    relative_urls: false,
    file_picker_types: "image",

    images_upload_handler: async (blobInfo) => {
      let formData = new FormData();
      formData.append("file", blobInfo.blob(), blobInfo.filename());

      try {
        let response = await $.ajax({
          url: "../includes/upload_image.php",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          dataType: "json",
        });

        if (response.status === "success") {
          return response.url;
        }
      } catch (error) {
        console.error("AJAX Error Response:", error);
        throw new Error("Upload error. Check console for details.");
      }
    },
  });
});
