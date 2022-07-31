## Hi there

> I'm not a professional React developer yet I'm still learning how things works, but I'm gonna practice things that I have learned so far.

### What I have to do

- A web app containing two pages - product list page and add product page.

  - The product list should be the accessible from the root of the app.
  - the product list page should have:

    - **"ADD"** `button` that should lead to the add product page.
    - **"MASS DELETE"** `button` that should delete all the selected product. (_Each product has a checkbox with class `.delete-checkbox`_)
    - ther should be a list of products with no pagination, Each product should have the information:
      - **"SKU"**, and have to be unique.
      - **"Name"**.
      - **"Price"**, in dollars $.
      - A product specific attribute and it's value:
        - _Size in MB_ for **DVD-disc**
        - _Weight in KG_ for book
        - _Height * Width * length_ for Furniture

  - The add product page should be accessible from root/add-product
  - The add product page should have
    - **"SAVE"** `button` that should save the product to the database.
    - **"CANCEL"** `button` that should lead to the product list page.
    - a **"Form"** with a `#product_form` id, it should contains:
      - SKU `input` that should be unique. (I'll check if there are existed products with the same SKU)
      - Name `input`
      - Price `input`
      - Product type `select` with the following options:
        - `DVD-disc`
        - `Book`
        - `Furniture`
      - > The form should be dynamically changed when the type is switched
      - > Special attributes should have a description, related to their type, e.g.: “Please, provide dimensions” / “Please, provide weight” / “Please, provide size” when related product type is selected.
      - > All fields are mandatory for submission, missing values should trigger notification “Please, submit required data”
      - > Implement input field value validation, invalid data must trigger notification “Please, provide the data of indicated type”.
