AOS.init();

var base_url = "includes/functions.php";
var relative_url = "../" + base_url;

$(window).on("scroll", function () {
  if ($(this).scrollTop() > 50) {
    $(".my-navbar").addClass("is-scrolled");
  } else {
    $(".my-navbar").removeClass("is-scrolled");
  }
});

var checkIsMobile = () => {
  return $(window).width() <= 576;
};
if (!checkIsMobile() && window.location.pathname.includes("search-blog")) {
  window.location.href = "index";
}
var showToastAlert = (message, options = {}) => {
  Toastify({
    text: message,
    duration: options.duration || 2000,
    gravity: options.gravity || "top",
    position: options.position || "left",
    backgroundColor: options.backgroundColor || "green",
  }).showToast();
};
var blogTemplateForHomepage = (blog) => {
  return `
   <div class="post-preview">
 <a href="single-blog?id=${blog.id}" class="post-head">
              <h2 class="post-title">${blog.title}</h2>
              <h3 class="post-subtitle">${blog.subtitle}</h3>
          </a>
          <p class="post-meta">
              Posted by <a href="javascript:void(0)" class="post-author">${blog.author}</a> on ${new Date(blog.created_at).toDateString()}
          </p>
          <hr class="my-4">
          </div>
  `;
};
var blogTemplateForSinglePost = (blog) => {
  return `
                      <div class="single-blog-heading" data-id="${blog.id}">
        <h1 class="main-heading">${blog.title}</h1>
        <p class="sub-heading">${blog.subtitle || ""}</p>
        <p class ="author-text">Posted by <span>${blog.author}</span> on ${new Date(blog.created_at).toDateString()}</p>
                  </div>
  `;
};
var blogTemplateForContent = (blog) => {
  return `
   <div class="post-body">${blog.content}</div>
  `;
};
var blogTemplateForDashboard = (blog) => {
  return `
                
                        <div class="blog-card">
                                               <div class="content">
                                                   <h2 class="post-title">${blog.title}</h2>
                                                    <h3 class="post-subtitle">${blog.subtitle}</h3>
                                                   <p class="post-author">By ${blog.author} on ${new Date(blog.created_at).toDateString()}</p>
                                                   <div class="post-body">${blog.content}</div>
                                                   <div class="actions">
                                                     <button class="edit-btn action-btn" data-id="${blog.id}">
                                                     <i class="fas fa-pencil"></i>
                                                     Edit</button>
                                                     <button class="delete-btn action-btn" data-id="${blog.id}">
                                                     <i class="fas fa-trash"></i>
                                                     Delete</button>
                                                   </div>
                                               </div>
                                           </div>
                   
  `;
};
var suggestionTemplate = (item) => {
  return `
    <li class="suggestion-item" data-id="${item.id}">
      <a href="single-blog.php?id=${item.id}" class="suggestion-link">${item.title}</a>
    </li>
  `;
};
var loadBlogsForDashboard = async () => {
  try {
    var response = await $.ajax({
      url: relative_url,
      method: "GET",
      data: { name: "get_all", scope: "user" },
      dataType: "json",
    });
    $(".spinner-border").hide();
    if (response.status === "empty") {
      $(".blog-list").append('<p class="no-blogs">No Blog Found!</p>');
      return;
    }
    $(".blog-list").empty();
    response.blogs.forEach((blog) => {
      $(".blog-list").append(blogTemplateForDashboard(blog));
    });
  } catch (error) {
    console.error("Error loading blogs:", error);
  }
};
var loadBlogsForHomepage = async () => {
  try {
    var response = await $.ajax({
      url: base_url,
      method: "GET",
      data: { name: "get_all", scope: "all" },
      dataType: "json",
    });
    $(".spinner-border").hide();
    if (response.status === "empty") {
      $(".post-cards").append('<p class="text-muted">No Blogs Found!</p>');
      return;
    }
    $(".post-cards").empty();
    response.blogs.forEach((blog) => {
      $(".post-cards").append(blogTemplateForHomepage(blog));
    });
  } catch (error) {
    console.error("Error loading blogs:", error);
  }
};
var loadSingleBlog = async () => {
  const postId = new URLSearchParams(window.location.search).get("id");
  try {
    var response = await $.ajax({
      url: base_url,
      data: { id: postId, name: "get_single_blog" },
      method: "GET",
      dataType: "json",
    });
    $(".single-blog").html(blogTemplateForSinglePost(response));
    $(".content-body").html(blogTemplateForContent(response));
  } catch (error) {
    console.error("Error loading blog:", error);
  }
};
var checkForPath = (pathname) => {
  return window.location.pathname.includes(pathname);
};
if (checkForPath("dashboard")) {
  loadBlogsForDashboard();
}
if (checkForPath("index")) {
  loadBlogsForHomepage();
}
if (checkForPath("single-blog")) {
  loadSingleBlog();
}
var disableButton = (button) => {
  $(button).prop("disabled", true);
};
var enableButton = (button) => {
  $(button).prop("disabled", false);
};

$(".create-blog-form").on("submit", async function (e) {
  e.preventDefault();
  tinymce.triggerSave();
  let formData = $(this).serialize();
  disableButton(".create-blog-btn");

  try {
    let response = await $.ajax({
      url: relative_url,
      method: "POST",
      data: formData + "&name=create_blog",
      dataType: "json",
    });

    if (response.status === "success") {
      showToastAlert("Blog posted successfully!");
      window.location.href = "dashboard";
    } else {
      alert("Error: " + response.message);
    }
  } catch (error) {
    console.error("Error creating blog:", error);
  }
  enableButton(".create-blog-btn");
});

$(".blog-list").on("click", ".delete-btn", async function () {
  const blogId = $(this).data("id");
  const card = $(this).closest(".blog-card");
  disableButton(this);
  try {
    const response = await $.ajax({
      url: relative_url,
      method: "DELETE",
      contentType: "application/json",
      data: JSON.stringify({ id: blogId }),
      dataType: "json",
    });

    if (response.status === "success") {
      card.fadeOut(function () {
        $(this).remove();
      });
      showToastAlert("Blog deleted successfully!");
    }
  } catch (error) {
    console.error("AJAX Error:", error);
    showToastAlert("Couldn't Delete Blog", { backgroundColor: "red" });
  }
});

$("#user-login-form").on("submit", async function (e) {
  e.preventDefault();

  var identifier = $("#identifier").val();
  var password = $("#password").val();

  try {
    let response = await $.ajax({
      type: "POST",
      url: base_url,
      data: { name: "user_login", identifier, password },
    });

    if (response.status === "success") {
      window.location.href = "admin/dashboard";
    } else {
      showToastAlert(response.message, { backgroundColor: "red" });
    }
  } catch (error) {
    console.error("AJAX Error:", error);
    showToastAlert("An error occurred during login. Please try again.", { backgroundColor: "red" });
  }
});

$("#user-registeration-form").on("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);
  formData.append("name", "user_register");

  try {
    var response = await $.ajax({
      type: "POST",
      url: base_url,
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
    });

    if (response.status === "success") {
      showToastAlert("Registration successful! Please Login to Continue");
      window.location.href = "login";
    } else {
      showToastAlert(response.message, { backgroundColor: "red" });
    }
  } catch (error) {
    console.error("AJAX Error:", error);
    showToastAlert("An error occurred during registration. Please try again.", { backgroundColor: "red" });
  }
});

$(".query").on("input", async function () {
  var query = $(this).val().trim();
  var suggestionsForBlogs = $(".suggestions");

  if (query.length < 0) {
    suggestionsForBlogs.empty().hide();
    return;
  }
  try {
    var response = await $.ajax({
      url: base_url,
      method: "GET",
      data: { query, name: "search_blog" },
      dataType: "json",
    });

    suggestionsForBlogs.empty().show();

    if (response.length === 0) {
      suggestionsForBlogs.html('<li class="no-results text-muted">No blogs found</li>');
      return;
    }
    suggestionsForBlogs.html(response.map(suggestionTemplate).join(""));
    $(".suggestion-item").on("click", function () {
      $(".query").val($(this).text().trim());
      $(".search-form").attr("data-id", $(this).attr("data-id"));
      suggestionsForBlogs.html("").hide();
    });
  } catch (err) {
    console.error("Unexpected error:", err);
  }
});

$("#search-form").on("submit", function (e) {
  e.preventDefault();
  disableButton(this);
  let blogId = $(".search-form").attr("data-id");
  if (blogId) {
    $(".query").val("");
    window.location.href = `single-blog?id=${blogId}`;
  } else {
    showToastAlert("No Blog Found!");
  }
  enableButton(this);
});

$(document).on("click", (e) => {
  if (!$(e.target).closest("#query, .suggestions").length) {
    $(".suggestions").hide();
  }
});

$(".blog-list").on("click", ".edit-btn", async function () {
  var id = $(this).attr("data-id");
  $("#edit-id").val(id);
  disableButton(this);
  try {
    let response = await $.ajax({
      url: relative_url,
      method: "GET",
      data: { id, name: "get_single_blog" },
      dataType: "json",
    });

    $(".edit-blog-data").each(function () {
      $(this).val(response[$(this).attr("name")]);
    });
    if (tinymce.get("content")) {
      tinymce.get("content").setContent(response.content);
    }
    $(".edit-blog-content").addClass("active");
  } catch (error) {
    console.error("Error fetching blog for edit:", error);
    showToastAlert("Failed to load blog data.", { backgroundColor: "red" });
  }
});

$("#edit-blog-form").on("submit", async function (e) {
  e.preventDefault();
  tinymce.triggerSave();
  let formData = Object.fromEntries(new FormData(this));
  formData.id = $("#edit-id").val();
  disableButton(".edit-blog-btn");
  try {
    let response = await $.ajax({
      url: relative_url,
      method: "PATCH",
      contentType: "application/json",
      data: JSON.stringify(formData),
    });
    if (response.status === "success") {
      showToastAlert("Blog updated successfully!");
      $(".edit-blog-content").removeClass("active");
      loadBlogsForDashboard();
      enableButton(".edit-btn");
    }
  } catch (error) {
    console.error("Error updating blog:", error);
    showToastAlert("Failed to update blog.", { backgroundColor: "red" });
  }
});

$(".close-edit").on("click", () => {
  $(".edit-blog-content").removeClass("active");
  enableButton(".edit-btn");
});
