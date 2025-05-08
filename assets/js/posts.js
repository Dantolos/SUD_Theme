const PostListContainer = document.querySelector(".sud__post_list_container");

const handleFetchPosts = async (posttype, filter = null) => {
  let result = [];

  // filter
  let searchfilter = "";
  let perPage = "6";
  let page = "1";

  let categories = filter?.category
    ? filter?.category.map((item) => item.id).join(",")
    : null;
  let tags = filter?.tag ? filter?.tag.map((item) => item.id).join(",") : null;

  let filterString = "";
  if (categories) {
    filterString = `cat=${categories}`;
  }

  if (tags) {
    if (categories) {
      filterString += `&`;
    }
    filterString += `sudtag=${tags}`;
  }
  /*
  let CONTENTWRAPPER = document.querySelector(
    `.content-hub-tab-content[data-content="${posttype}"]`,
  );
  searchfilter = CONTENTWRAPPER.dataset.search
    ? `search=${CONTENTWRAPPER.dataset.search}`
    : "";
  let page = CONTENTWRAPPER.dataset.page ? CONTENTWRAPPER.dataset.page : "1";
  let perPage = "6";
  */

  let resp = await fetch(
    `${globalURL.baseUrl}/wp-json/wp/v2/${posttype}?${filterString}&${searchfilter}&per_page=${perPage}&page=${page}`,
  )
    .then((response) => {
      totalPages = response.headers.get("x-wp-totalpages");
      //handlePagination(totalPages);
      console.log("total Pages: " + totalPages);
      return response.json();
    })
    .then((posts) => {
      posts.forEach(async (post) => {
        //console.log(post);
        result.push(post);
      });
    })
    .catch((error) => {
      console.log("Error fetching posts:", error);
    });

  console.log(result);
  return result;
};

const initialPostLoad = async () => {
  const posts = await handleFetchPosts("posts");
  //console.log(posts);
  posts.forEach(async (post) => {
    //console.log(post);
    PostListContainer.append(await createPostDIV(post));
  });
};
initialPostLoad();

const createPostDIV = async (content) => {
  //console.log(content);
  let PostLink = document.createElement("a");
  PostLink.href = content.link;

  let PostWrapper = document.createElement("div");
  let PostDiv = document.createElement("div");
  PostWrapper.className = "post-item";
  PostDiv.className = "post-div";
  PostDiv.classList.add("skeletton");

  let PostImage = document.createElement("div");
  PostImage.className = "post-featured-image";
  if (content.acf.feature_image) {
    let imageInfo = await loadFeatureImage(content.acf.feature_image);
    PostImage.style.backgroundImage = "url(" + imageInfo + ")";
  }

  let PostTitle = document.createElement("h3");
  PostTitle.className = "fxs skeletton";
  PostTitle.innerHTML = content.acf.titel
    ? content.acf.titel
    : content.title.rendered;

  let PostExcerpt = document.createElement("p");
  PostExcerpt.className = "";
  PostExcerpt.innerHTML = content.acf.excerpt;

  let PublishDate = document.createElement("p");
  PublishDate.className = "";
  PublishDate.innerHTML = new Date(content.date)
    .toLocaleString("en-GB", {
      day: "numeric",
      month: "long",
      year: "numeric",
    })
    .replace(",", ".");

  //Categorie handling
  let CategoryContainer = "";
  if (Array.isArray(content.categories)) {
    CategoryContainer = document.createElement("div");
    CategoryContainer.className = "post-item-category-container";
    content.categories.forEach(async (category) => {
      let CategoryItem = document.createElement("div");
      CategoryItem.className = "post-item-category-item";
      CategoryItem.innerHTML = await loadCategoryById(category);
      let categoryname = await loadCategoryById(category);
      CategoryContainer.append(CategoryItem);
    });
  }
  console.log(content);
  //Tag handling
  let TagContainer = "";
  if (Array.isArray(content.tags)) {
    TagContainer = document.createElement("div");
    TagContainer.className = "post-item-tag-container";
    content.tags.forEach(async (tag) => {
      let TagItem = document.createElement("div");
      TagItem.className = "post-item-tag-item";
      TagItem.innerHTML = await loadTagById(tag);
      //let categoryname = await loadCategoryById(category);
      TagContainer.append(TagItem);
    });
  }

  //generate output
  let PostContent = document.createElement("div");
  PostContent.className = "post-item-content";
  PostContent.append(
    PublishDate,
    PostTitle,
    TagContainer,
    PostExcerpt,
    CategoryContainer,
  );

  PostWrapper.append(PostImage, PostContent);
  PostLink.append(PostWrapper);

  return PostLink;
};

const loadFeatureImage = async (imageID) => {
  let image = await fetch(`${globalURL.baseUrl}/wp-json/wp/v2/media/${imageID}`)
    .then((response) => {
      return response.json();
    })
    .then((image) => {
      return image;
    })
    .catch((error) => {
      console.log("Error fetching image:", error);
    });

  return image.guid.rendered;
};

const loadCategoryById = async (categoryID) => {
  let category = await fetch(
    `${globalURL.baseUrl}/wp-json/wp/v2/categories/${categoryID}`,
  ).then((response) => {
    return response.json();
  });
  return category.name;
};

const loadTagById = async (tagID) => {
  let tag = await fetch(
    `${globalURL.baseUrl}/wp-json/wp/v2/tags/${tagID}`,
  ).then((response) => {
    return response.json();
  });
  return tag.name;
};

//FILTER LOGIC
const FilterArgs = {
  category: null,
  tag: null,
};

const handleCategoryChange = (select) => {
  const selectedValues = Array.from(select.selectedOptions).map((option) => ({
    id: option.value,
    name: option.dataset.category,
  }));
  if (!Array.isArray(FilterArgs.category)) {
    FilterArgs.category = [];
  }
  FilterArgs.category.push(...selectedValues);
  console.log(FilterArgs);
  filterSummary(FilterArgs.category, "category");
};

const handleTagChange = (select) => {
  const selectedValues = Array.from(select.selectedOptions).map((option) => ({
    id: option.value,
    name: option.dataset.tag,
  }));
  if (!Array.isArray(FilterArgs.tag)) {
    FilterArgs.tag = [];
  }
  FilterArgs.tag.push(...selectedValues);
  console.log(FilterArgs);
  filterSummary(FilterArgs.tag, "tag");
};

const filterSummary = (filterArgs, type) => {
  const summaryContainer = document.querySelector(
    `.sud__selection_${type}_summary`,
  );

  // Categorie List
  let itemListContainer;
  if (!document.getElementById(`sud__${type}_list`)) {
    itemListContainer = document.createElement("div");
    itemListContainer.id = `sud__${type}_list`;
    itemListContainer.className = `sud__${type}_list`;
  } else {
    itemListContainer = document.getElementById(`sud__${type}_list`);
  }

  if (filterArgs && filterArgs.length > 0) {
    itemListContainer.innerHTML = "";
    filterArgs.forEach((item) => {
      let filterItem = document.createElement("div");
      filterItem.innerHTML = item.name;
      filterItem.id = `${type}_item_${item.id}`;
      filterItem.className = "sud__filter_item";

      let removeIcon = document.createElement("button");
      removeIcon.innerHTML = "X";
      removeIcon.className = `sud__${type}_remove_${item.id}`;
      removeIcon.dataset.catid = item.id;
      filterItem.append(removeIcon);

      itemListContainer.append(filterItem);
      itemListContainer.addEventListener("click", (e) => {
        let itemId = e.target.dataset.catid;
        document.getElementById(`${type}_item_${itemId}`).remove();
        FilterArgs[type] = removeById(FilterArgs[type], itemId); //remove cat element from fillerArgs
        document.getElementById(`sud__${type}_potion_${itemId}`).disabled =
          false;
        reloadPostsOnFilterChange(FilterArgs);
      });

      document.getElementById(`sud__${type}_potion_${item.id}`).disabled = true;
    });
  }

  //RELOAD POSTS
  reloadPostsOnFilterChange(FilterArgs);
  summaryContainer.append(itemListContainer);
};

function removeById(arr, id) {
  const index = arr.findIndex((obj) => obj.id === id);
  if (index !== -1) arr.splice(index, 1);
  console.log(arr);
  return arr;
}

async function reloadPostsOnFilterChange(args) {
  let posts = await handleFetchPosts("posts", args);
  console.log(posts);
  posts.forEach(async (post) => {
    //console.log(post);
    PostListContainer.innerHTML = "";
    PostListContainer.append(await createPostDIV(post));
  });
}
