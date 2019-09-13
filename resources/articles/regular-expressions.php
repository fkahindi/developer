<h1>Regular Expressions</h1>
<p>Regular expressions (a.k.a regexp) are special formatted character strings that are used to find patterns in text. RegExp can be used to validate whether a user entered correct data in a form, before the form is processed by the server or whether certain text patterns exist in a  block of text. Various programming languages such PHP, Java, JavaScript and Perl use regular expressions to process and manipulate text. While there's alot in common in how each of these languages utilize regular expressions their implementing vary. In this tutotial, we are going to use JavaScript to evaluate regular expressions. </P>

<h3>Regular Expression Syntax</h3>
<p>The syntax of a regular expression involve special characters that are given special meaning within the regular expression. The special characters are: <code><strong>. ? * + [ ]( ){ } ^ | \</strong></code>. These characters have a special meaning in a regular expression and cannot be used literally, unless properly escaped. To use a special character as a regular one you need to escape it by typing a backslash before the character. For example if to find a dot ('<code>.</code>') in a string you will need to type <code>\.</code> in the regular expression. We will explore how they are used shortly.</p>
<h3>Patterns and Flags</h3>
<p>A regular expression syntax consists of a <em>pattern</em> and an optional <em>flag</em>. There are two ways to construct a regular expression: </p>
<ol>
	<li>Using the object construct (long form)</li>
	<li>Using the literal construct (short form)</li>
</ol>
<p>The object construct looks like:</p>
<code>regexp = new RegExp("pattern", "flags")</code>
<h4>Example</h4>
<code>var myRegEx = new RegExp('abc');</code>
<p>The literal construct makes use of slashes <code>"/"</code>. Anything put in between the slashes<code>"/"</code> is treated as a regular expression.</p>
<h4>Example</h4>
<code>regexp = /pattern/ ; // with no flags;
regexp = /pattern/gmi; // with flags g, m and i 
</code>
<p>In the second construct the <code>"/"</code> tells JavaScript that the characters in between the "/" is a regular expression, just like quotation marks we use for strings.</p> <p> Ok, you might be yearning to test these expressions, but before you do so you need a platform. We will use the bowser Console panel in Web Developer tools to practise, before we develop a form and apply the skills learned. To access Web Developer tools use the specific browser's menu or short-cut keys. FireFox and Microsoft Edge use <code>Shift + F12</code>; Chrome and Opera browsers use <code>Ctrl + Shift + I</code> as short-cut to Developer tools. If Develop menu is not displayed on Safari use Preferences - Advanced tab and check the Show Develop menu box</p>
<h3>Character Classes</h3>
<p>Before we start practising let's character classes. Character class is a list of charachters listed within square brackets in which any of them can be used as a match. For example an expression <code>[abcd]</code> matches a, b, c or d only. If you want to match any other character apart from a, b, c or d you need to negate using the special character carat ( ^) just after the opening square bracket <code>[</code>, i.e <code>[^abcd]</code>. To match a range of characters a hyphen (-) can be used, e.g. <code>[a-z]</code> matches all lowercase alphabet a to z.</p>
<p>Let's look at the possibilities of the character classes</p>
<table>
	<tr><th>RegExp</th><th>What it means</th></tr>
	<tr><td>[abc]</td><td>Matches any one of the characters a, b or c.</td></tr>
	<tr><td>[^abc]</td><td>Matches any character other than a, b or c.</td></tr>
	<tr><td>[a-z]</td><td>Matches any lowercase letter between a and z.</td></tr>
	<tr><td>[A-Z]</td><td>Matches any uppercase letter between A and Z.</td></tr>
	<tr><td>[a-Z]</td><td>Matches any letter between lowercase a and Z uppercase.</td></tr>
	<tr><td>[0-9]</td><td>Matches any digit between 0 and 9.</td></tr>
	<tr><td>[a-z0-9]</td><td>Matches any character between a and z or 0 to 9.</td></tr>
</table>
<p>Let's get some examples that implement these classes.</p>
<h4>Example</h4>
<p>We have a string of text and we want search for a particular word within the text. We can use the method <code>search</code> to do that. Type the following in the browser Console: </p>
<pre>
	<code>
		var str = "I am learning JavaScript and it is good";
		var regEx = /good/;
		alert(str.search(regEx));  
	</code>
</pre>
<p><code>str.search(regEx)</code> will return the position of word "good" which is 35. We can also use the method <code>match</code> to test whether "good" exists in the string. If it does, it will return the itself. Change the alert in the Console to the following:</p>
<pre>
	<code>
		alert(str.search(regEx));  
	</code>
</pre>
<p>What is important to note is that <code>str.search(regEx)</code> returns the position of the first match or -1 if a match is not found. If we want to find the next match we have to use another method. </p>

<h3>Predefined Character Classes</h3>
<p>Some character classes are frequently used such that there has been developed short-cuts of defining them. The following characters fall into this class</p>
<table>
	<tr><th>Class short-cut</th><th>What it does</th></tr>
	<tr><td><strong>\w</strong></td><td>Matches any word character a to z, A to Z, 0 to 9 and underscore. Same as <strong>[a-zA-Z_0-9]</strong></td></tr>
	<tr><td><strong>\W</strong></td><td>Matches any non-word character. Same as <strong>[^a-zA-Z_0-9]</strong></td></tr>
	<tr><td><strong>.</strong></td><td>Matches any single character except a line break <strong>\n</strong></td></tr>
	<tr><td><strong>\d</strong></td><td>Matches any digit character. Same as <strong>[0-9]</strong></td></tr>
	<tr><td><strong>\D</strong></td><td>Matches any non-digit character. Same as <strong>[^0-9]</strong></td></tr>
	<tr><td><strong>\s</strong></td><td>Matches any whitespace character including space, tab, newline or carriage return. Same as <strong>[ \t\n\r]</strong></td></tr>
	<tr><td><strong>\S</strong></td><td>Matches any non-whitespace character. Same as <strong>[^ \t\n\r]</strong></td></tr>
</table>

