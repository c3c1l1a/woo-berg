(() => {
  // src/wp-shim.js
  var useBlockProps = window.wp.blockEditor.useBlockProps;
  var __ = window.wp.i18n.__;

  // src/edit.js
  function Edit() {
    return /* @__PURE__ */ React.createElement("p", {
      ...useBlockProps()
    }, __("Gutenpride \u2013 hello from the editor!", "gutenpride"));
  }

  // src/save.js
  var __2 = window.wp.i18n.__;
  var useBlockProps2 = window.wp.blocks.useBlockProps;
  function save() {
    return /* @__PURE__ */ React.createElement("p", null, __2("Gutenpride \u2013 hello from the saved content!", "gutenpride"));
  }

  // src/index.js
  var registerBlockType = window.wp.blocks.registerBlockType;
  registerBlockType("wooberg/wooberg-test", {
    edit: Edit,
    save,
    apiVersion: 2,
    title: "Wooberg Test",
    description: "This is for testing..."
  });
})();
