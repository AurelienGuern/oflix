# CSS Selector Reference

-----
In CSS, selectors are patterns used to select the element(s) you want to style.

|**Selector**|**Example**|**Example description**|
| :-: | :-: | :-: |
|[.*class*](https://www.w3schools.com/cssref/sel_class.php)|.intro|Selects all elements with class="intro"|
|*.class1.class2*|.name1.name2|Selects all elements with both *name1* and *name2* set within its class attribute|
|*.class1 .class2*|.name1 .name2|Selects all elements with *name2* that is a descendant of an element with *name1*|
|[#*id*](https://www.w3schools.com/cssref/sel_id.php)|#firstname|Selects the element with id="firstname"|
|[*](https://www.w3schools.com/cssref/sel_all.php)|\*|Selects all elements|
|[*element*](https://www.w3schools.com/cssref/sel_element.php)|p|Selects all \<p> elements|
|[*element.class*](https://www.w3schools.com/cssref/sel_element_class.php)|p.intro|Selects all \<p> elements with class="intro"|
|[*element,element*](https://www.w3schools.com/cssref/sel_element_comma.php)|div, p|Selects all \<div> elements and all \<p> elements|
|[*element* *element*](https://www.w3schools.com/cssref/sel_element_element.php)|div p|Selects all \<p> elements inside \<div> elements|
|[*element*>*element*](https://www.w3schools.com/cssref/sel_element_gt.php)|div > p|Selects all \<p> elements where the parent is a \<div> element|
|[*element*+*element*](https://www.w3schools.com/cssref/sel_element_pluss.php)|div + p|Selects the first \<p> element that is placed immediately after \<div> elements|
|[*element1*~*element2*](https://www.w3schools.com/cssref/sel_gen_sibling.php)|p ~ ul|Selects every \<ul> element that is preceded by a \<p> element|
|[\[*attribute*\]](https://www.w3schools.com/cssref/sel_attribute.php)|[target]|Selects all elements with a target attribute|
|[\[*attribute*=*value*\]](https://www.w3schools.com/cssref/sel_attribute_value.php)|[target="\_blank"]|Selects all elements with target="\_blank"|
|[\[*attribute*~=*value*\]](https://www.w3schools.com/cssref/sel_attribute_value_contains.php)|[title~="flower"]|Selects all elements with a title attribute containing the word "flower"|
|[\[*attribute*\|=*value*\]](https://www.w3schools.com/cssref/sel_attribute_value_lang.php)|[lang\|="en"]|Selects all elements with a lang attribute value equal to "en" or starting with "en-"|
|[\[*attribute*^=*value*\]](https://www.w3schools.com/cssref/sel_attr_begin.php)|a[href^="https"]|Selects every \<a> element whose href attribute value begins with "https"|
|[\[*attribute*$=*value*\]](https://www.w3schools.com/cssref/sel_attr_end.php)|a[href$=".pdf"]|Selects every \<a> element whose href attribute value ends with ".pdf"|
|[\[*attribute**=*value*\]](https://www.w3schools.com/cssref/sel_attr_contain.php)|a[href\*="w3schools"]|Selects every \<a> element whose href attribute value contains the substring "w3schools"|
|[:active](https://www.w3schools.com/cssref/sel_active.php)|a:active|Selects the active link|
|[::after](https://www.w3schools.com/cssref/sel_after.php)|p::after|Insert something after the content of each \<p> element|
|[::before](https://www.w3schools.com/cssref/sel_before.php)|p::before|Insert something before the content of each \<p> element|
|[:checked](https://www.w3schools.com/cssref/sel_checked.php)|input:checked|Selects every checked \<input> element|
|[:default](https://www.w3schools.com/cssref/sel_default.php)|input:default|Selects the default \<input> element|
|[:disabled](https://www.w3schools.com/cssref/sel_disabled.php)|input:disabled|Selects every disabled \<input> element|
|[:empty](https://www.w3schools.com/cssref/sel_empty.php)|p:empty|Selects every \<p> element that has no children (including text nodes)|
|[:enabled](https://www.w3schools.com/cssref/sel_enabled.php)|input:enabled|Selects every enabled \<input> element|
|[:first-child](https://www.w3schools.com/cssref/sel_firstchild.php)|p:first-child|Selects every \<p> element that is the first child of its parent|
|[::first-letter](https://www.w3schools.com/cssref/sel_firstletter.php)|p::first-letter|Selects the first letter of every \<p> element|
|[::first-line](https://www.w3schools.com/cssref/sel_firstline.php)|p::first-line|Selects the first line of every \<p> element|
|[:first-of-type](https://www.w3schools.com/cssref/sel_first-of-type.php)|p:first-of-type|Selects every \<p> element that is the first \<p> element of its parent|
|[:focus](https://www.w3schools.com/cssref/sel_focus.php)|input:focus|Selects the input element which has focus|
|[:fullscreen](https://www.w3schools.com/cssref/sel_fullscreen.php)|:fullscreen|Selects the element that is in full-screen mode|
|[:hover](https://www.w3schools.com/cssref/sel_hover.php)|a:hover|Selects links on mouse over|
|[:in-range](https://www.w3schools.com/cssref/sel_in-range.php)|input:in-range|Selects input elements with a value within a specified range|
|[:indeterminate](https://www.w3schools.com/cssref/sel_indeterminate.php)|input:indeterminate|Selects input elements that are in an indeterminate state|
|[:invalid](https://www.w3schools.com/cssref/sel_invalid.php)|input:invalid|Selects all input elements with an invalid value|
|[:lang(*language*)](https://www.w3schools.com/cssref/sel_lang.php)|p:lang(it)|Selects every \<p> element with a lang attribute equal to "it" (Italian)|
|[:last-child](https://www.w3schools.com/cssref/sel_last-child.php)|p:last-child|Selects every \<p> element that is the last child of its parent|
|[:last-of-type](https://www.w3schools.com/cssref/sel_last-of-type.php)|p:last-of-type|Selects every \<p> element that is the last \<p> element of its parent|
|[:link](https://www.w3schools.com/cssref/sel_link.php)|a:link|Selects all unvisited links|
|[::marker](https://www.w3schools.com/cssref/sel_marker.php)|::marker|Selects the markers of list items|
|[:not(*selector*)](https://www.w3schools.com/cssref/sel_not.php)|:not(p)|Selects every element that is not a \<p> element|
|[:nth-child(*n*)](https://www.w3schools.com/cssref/sel_nth-child.php)|p:nth-child(2)|Selects every \<p> element that is the second child of its parent|
|[:nth-last-child(*n*)](https://www.w3schools.com/cssref/sel_nth-last-child.php)|p:nth-last-child(2)|Selects every \<p> element that is the second child of its parent, counting from the last child|
|[:nth-last-of-type(*n*)](https://www.w3schools.com/cssref/sel_nth-last-of-type.php)|p:nth-last-of-type(2)|Selects every \<p> element that is the second \<p> element of its parent, counting from the last child|
|[:nth-of-type(*n*)](https://www.w3schools.com/cssref/sel_nth-of-type.php)|p:nth-of-type(2)|Selects every \<p> element that is the second \<p> element of its parent|
|[:only-of-type](https://www.w3schools.com/cssref/sel_only-of-type.php)|p:only-of-type|Selects every \<p> element that is the only \<p> element of its parent|
|[:only-child](https://www.w3schools.com/cssref/sel_only-child.php)|p:only-child|Selects every \<p> element that is the only child of its parent|
|[:optional](https://www.w3schools.com/cssref/sel_optional.php)|input:optional|Selects input elements with no "required" attribute|
|[:out-of-range](https://www.w3schools.com/cssref/sel_out-of-range.php)|input:out-of-range|Selects input elements with a value outside a specified range|
|[::placeholder](https://www.w3schools.com/cssref/sel_placeholder.php)|input::placeholder|Selects input elements with the "placeholder" attribute specified|
|[:read-only](https://www.w3schools.com/cssref/sel_read-only.php)|input:read-only|Selects input elements with the "readonly" attribute specified|
|[:read-write](https://www.w3schools.com/cssref/sel_read-write.php)|input:read-write|Selects input elements with the "readonly" attribute NOT specified|
|[:required](https://www.w3schools.com/cssref/sel_required.php)|input:required|Selects input elements with the "required" attribute specified|
|[:root](https://www.w3schools.com/cssref/sel_root.php)|:root|Selects the document's root element|
|[::selection](https://www.w3schools.com/cssref/sel_selection.php)|::selection|Selects the portion of an element that is selected by a user|
|[:target](https://www.w3schools.com/cssref/sel_target.php)|#news:target |Selects the current active #news element (clicked on a URL containing that anchor name)|
|[:valid](https://www.w3schools.com/cssref/sel_valid.php)|input:valid|Selects all input elements with a valid value|
|[:visited](https://www.w3schools.com/cssref/sel_visited.php)|a:visited|Selects all visited links|

