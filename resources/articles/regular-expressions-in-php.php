<h1>Regular Expressions in PHP</h1>
<p>Regular expressions (a.k.a regexp) are special formatted character sequence used to find patterns in text. These expressions are so important that they are almost a programming language of their own. Regexp can be used to validate whether a user entered correct data in a form, even before the form is processed by the server or whether certain patterns exist in a  block of text. Various programming languages such PHP, Java, JavaScript and Perl use regular expressions to process and manipulate text. While there's alot in common in how each of these languages utilize regular expressions, their implementation vary slightly. In this tutotial, we are going to use regular expressions in PHP. </P>

<h2>Regular Expression Syntax</h2>
<p>The syntax of a regular expression involve special characters that are given special meaning within the regular expression. The special characters are: <code><strong> . ? * + [ ]( ){ } ^ | \</strong></code>. These characters have a special meaning in a regular expression and cannot be used literally, unless they are properly escaped. To use a special character as a regular one you need to escape it by typing a backslash before the character. For example to find a dot ('<code>.</code>') in a string you will need to type <code>\.</code> in the regular expression to make it a regular dot. We will explore how they are used shortly.</p>
<h3>Patterns and Flags</h3>
<p>A regular expression syntax consists of a <em>pattern</em> and an optional <em>flag</em>. The <em>pattern</em> will almost always involve one or more of the special characters listed above. Flags are be used when you want to change the behavior of how the matching is to be done. More on that later.  Further, there are two ways on how to construct a regular expression: </p>
<ol>
	<li>Using the object construct (long form)</li>
	<li>Using the literal construct (short form)</li>
</ol>
<p>The object construct syntax looks like this:</p>
<pre class="prettyprint">

	regexp = new RegExp('pattern', 'flags')
	
</pre>
<h4>Example</h4>
<pre class="prettyprint">

	$my_regex = new RegExp('abc');
	
</pre>
<p>On the other hand the literal construct makes use of forward slashes <code>"/"</code>. Anything put in between the slashes<code>"/"</code> is treated as a regular expression. Its syntax looks like this:</p>
<pre class="prettyprint">

	$my_regexp = '/pattern/' ; // with no flags;
	$my_regexp = '/pattern/gmi'; // with flags g, m and i
	
</pre>
<h4>Example</h4>
<pre class="prettyprint">

	$my_regex ='/abc/'; 
	
</pre>
<p>In the literal construct the <code>"/"</code> tells PHP that the characters in between the "/" is a regular expression, just like quotation marks we use for strings. We are storing this regular expression in a variable <code>my_regex</code> and when using it, we are essentially telling PHP to find whether the string we are matching contain characters abc in their proper order. In this tutorial we will concentrate on using the literal construct to build regular expressions.</p> 
<h3>Character Classes</h3>
<p>A character class is a set of charachters listed within square brackets in which any of them can be used as a match. For example if we want to match the characters a, b, or c in a single position we would write the expression as a set <code>[abc]</code>. This means we want are match if a, b or c occur in a string and they don't have to be the order abc. So, if the string we are matching against has any one of the letters a, b or c it will return "true". In case you want to match any other characters apart from a, b or c,  you would need to negate the class by using the special character carat (<code>^</code>) just after the opening square bracket <code>[</code>, i.e <code>[^abcd]</code>. If you want to match a range of characters you will need a hyphen (<code>-</code>). For example <code>[a-z]</code> matches any lowercase letter from a to z. The below table lists the possibilities of character classes you can form</p>
<table>
	<tr><th>RegExp</th><th>What it means</th></tr>
	<tr><td>[abc]</td><td>Matches any one of the characters a, b or c</td></tr>
	<tr><td>[^abc]</td><td>Matches any character other than a, b or c</td></tr>
	<tr><td>[a-z]</td><td>Matches any lowercase letter between a and z</td></tr>
	<tr><td>[A-Z]</td><td>Matches any uppercase letter between A and Z</td></tr>
	<tr><td>[a-Z]</td><td>Matches any letter between lowercase a through uppercase Z</td></tr>
	<tr><td>[0-9]</td><td>Matches any digit between 0 and 9</td></tr>
	<tr><td>[a-z0-9]</td><td>Matches any character between a and z or 0 to 9</td></tr>
</table>
<h3>PHP Matching Functions</h3>
<p>PHP has several in-built functions we can use with our regular expressions to match against any string. Listed below are the preg_ family functions. <code>preg_</code> stands for <em>PHP regular expression</em></p>
<table>
	<tr><th>Functions</th><th>What it does</th></tr>
	<tbody>
	<tr><td>preg_match()</td><td>Searches a string for a pattern and returns true if pattern exists</td></tr>
	<tr><td>preg_match_all()</td><td>Performs a global regular expression match</td></tr>
	<tr><td>preg_replace()</td><td>Performs a regular expression search and replace</td></tr>
	<tr><td>preg_grep()</td><td>returns the elements of the input array that matched the pattern</td></tr>
	<tr><td>preg_split()</td><td>Splits a string into substrings using a regular expression</td></tr>
	<tr><td>preg_quote()</td><td>Quotes regular expression characters found in a string</td></tr>
	</tbody>
</table>
<p>Note: The difference between <code>preg_match()</code> and <code>preg_match_all()</code> is that <code>preg_match()</code> will stop when it finds the first match in the string, but <code>preg_match_all()</code> will continue to the end of the string and return all possible matches.</p>
<p>Let's use some of these functions to test regular expressions. Create a PHP file and run the following code.</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "Little foxes spoil the vines.";
	$pattern = "/vines/";
	if(preg_match($pattern, $txt)){
		echo "A match was found";
	}else{
		echo "There are no matches there!";
	}
?&gt;
</pre>
<p>The above code will return "A match was found". This time change the regualar expression pattern to "little" as shown below and run the code:</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "Little foxes spoil the vines.";
	$pattern = "/little/";
	if(preg_match($pattern, $txt)){
		echo "A match was found";
	}else{
		echo "There are no matches there!";
	}
</pre>
<p>The above code will return "There are no matches there!" Why? Well, the regular expression we have built is case sensitive, so "little" cannot match "Little". To make it case insensitive so that it can match all cases of "little" we add a flag (pattern modifier) <code>i</code> as shown below</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "Little foxes spoil the vines.";
	$pattern = "/little/i";
	if(preg_match($pattern, $txt)){
		echo "A match was found";
	}else{
		echo "There are no match there!";
	}
</pre>
<p>Now if you run the above code there will be a match. When a regular expression is case-insensitive it matches uppercase and lowercase letters alike. In other words, the above expression can match "Little", "LITTLE", "Little" or whichever way little has been typed. Other pattern modifiers (flags) will be explained later.</p>
<p>This time let's create a regular expression using a character class. We want our regular expression to find whether we have "rat" or "cat" in a given string. So we type it as shown in the code below</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "Which rat will bell the cat?";
	$pattern = "/[rc]at/";
	if(preg_match($pattern, $txt)){
		echo "A match was found";
	}else{
		echo "There are no matches there!";
	}
</pre>
<p>Running the above code will return "A match was found" but does not tell us how many. Let's modify the code and use the <code>preg_match_all</code> to determine how many matches it found.</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "Which rat will bell the cat?";
	$pattern = "/[rc]at/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches were found";
</pre>
<p>Now, if you run the above code it will return "two matches were found". Of course from the above string, the only possible matches are rat and cat. You can verify that by deleting either one from the string and you will get one match. Remove both and you get 0 matches.</p>
<p>We can also use a range character set to build a regular expression like the one below</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "hearing a loud bang filled her with fear";
	$pattern = "/[f-h]ear/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches were found"; //Matches words with fear, gear and hear. Two matches in this case.
</pre>
<p>Let's move further and look at other scenarios. How would we match "chief" and "chef" in the string <em>"The chief recommended all indigenous recipies to the chef"</em>? If we use "/ch[ie]f/" we get one match. On investigation we find that it matched "chef" but not "chief". If we use "/ch[i]ef/" we get one match, actually it matched "chief" and left out "chef".</p> 
<p>
Well, one thing you need to take note of is that the character class matches any of the characters listed in the set in a single position. Whatever is typeed outside the character class must be matched as they are. I hope you understand what I mean. Now, to solve our problem we will have to add a quantifier <code>*</code> just after the character class. I will explain quantifiers after this illustration. So, the code should now look like the one below <p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "The chief recommended all indigenous respies to the chef";
	$pattern = "/ch[i]*ef/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found";
</pre>
<p>The quantifier <code>*</code> is telling PHP to match "chef" or "chief" if "i" appears between "ch" and "ef". </p>
<h3>Quantifiers</h3>
<p>Quantifiers help us to match more than one character or a pattern in a number of ways. Remember I stated above that the character class seeks to match a single character for the possibilities listed in the class. What if you want to find a match of a repeated character or more than one character. That's where these quantifiers come in. Below is list of the repetition quantifiers and what they do. We will use letter f to explain what the symbols stand for.</p>
<table>
	<tr><th>RegEx</th><th>What it means</th></tr>
	<tbody>
	<tr><td>f*</td><td>Matches f zero or more times</td></tr>
	<tr><td>f+</td><td>Matches f one or more times</td></tr>
	<tr><td>f?</td><td>Matches f zero or one time</td></tr>
	<tr><td>^f</td><td>Matches f if it begins the string</td></tr>
	<tr><td>f$</td><td>Matches f if it ends the string</td></tr>
	<tr><td>f{3}</td><td>Matches exactly three occurences of the letter f</td></tr>
	<tr><td>f{3,5}</td><td>Matches at least three but not more than five occurances of letter f</td></tr>
	<tr><td>f{3,}</td><td>Matches at least three or more occurences of letter f</td></tr>
	<tr><td>f{,3}</td><td>Matches at most three occurences of letter f</td></tr>
	<tr><td>f|g</td><td>Matches either f or g</td></tr>
	</tbody>
</table>
<p>You may have noticed that the symbols listed above consists the same special characters we listed at the beginning of this tutorial. Let's look at some examples that use some of these quantifiers. We will still use <code>preg_match_all()</code> function just to get how many matches the regular expression has found.</p> 
<p>Let's revisit the previous code. If we used the quantifier <code>+</code> instead of <code>*</code> like <code>/ch[i]+ef/</code> it wouldn't work, because this expression expects at least one "i" between "ch" and "ef". However, we can modify the expression to make it use of the <code>+</code> quntifier by taking letter "e" into the class, i.e. <code>/ch[ie]+f/</code>, which can also match "chief" and "chef". But, please note that <code>/ch[i]*ef/</code> and <code>/ch[ie]+f/</code> do not mean the same thing. The former exactly matches "chief" and "chef" while the latter matches a host of words apart from "chief" and "chef" including "chiif", "cheeef", "chiieeef" as the expression indicates. Understanding what the expression mean is the first step to achieving desired result. The second is testing the expression.</p>
<p>Let's move on. Run the following code using <code>?</code> qauntifier.</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "sweet candy";
	$pattern = "/swe?t/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found"; //Zero match
</pre>
<p>There is a zero match because pattern <code>/swe?t/</code> matches "swt" and "swet" but not "sweet". It means the character preceding to <code>?</code> i.e. "e" is optional. To match "sweet" using the special character <code>?</code> we can change the pattern to  <code>/swee?t/</code> but it will also match "swet" </p>
<p>The pattern <code>/^c/</code> below matches "caroline" but not "issac" because "c" must be starting the string.</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "caroline and issac";
	$pattern = "/^c/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found"; //Matches caroline
</pre>
<p>The pattern <code>/c$/</code> below matches "issac" but not "caroline" because "c" must be ending the string.</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "caroline and issac";
	$pattern = "/c$/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found"; //Matches caroline
</pre>
<p>Let's consider the word "sweet" again. If we want to match exactly "sweet" and not both "swet" and "sweet" as in the prevous case, we can build the regualar expression to require exactly "ee" between "w" and "t" as shown below: </p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "sweet candy";
	$pattern = "/swe{2}t/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found"; //1 match found
</pre>
<p>To match "sweet","sweeet","sweeeet" we would use the expression <code>/swe{2,}t/</code>. To restrict the number of e's to be between 2 and 3, type it as shown below. </p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "sweeet candy";
	$pattern = "/swe{2,3}t/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found";// Matches sweet and sweeet only 
</pre>
<p>To match either one of two options such as "green" or "red" light. You can use the expression as the one shown below:</p>

<pre class="prettyprint linenums">
&lt;?php
	$txt = "red lights";
	$pattern = "/green|red/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found";//1 match found
</pre>
<h3>Pattern Modifiers (Flags)</h3>
<p>The flags we referred to as optional in the regular expressions syntax at the beginning of the tutotial are pattern modifiers. They change the way the pattern will evaluate the string to be matched. You should note that in certain circumstances they are mandatory based on what you want to achieve. Listed are the commonly used flags. </p>
<table>
	<tr><th>Flag</th><th>What it does</th></tr>
	<tbody>
	<tr><td>i</td><td>Makes the match to be case-insensitive.</td></tr>
	<tr><td>g</td><td>global match. Matches all occurances.</td></tr>
	<tr><td>m</td><td>Multi-line match. Changes the behavior of ^ and $ to match the start and end of a newline instead of start and end of a string. </td></tr>
	<tr><td>s</td><td>Changes the behavior of the dot (.) to match all characters including newline. </td></tr>
	<tr><td>o</td><td>Evaluates the expression only once. </td></tr>
	<tr><td>x</td><td>Allow comments and whitespace to be used in patterns for clarity.</td></tr>
	</tbody>
</table>
<p>Hence forth we shall use the flags whenever necessary and will explain how they modify the specific regular expression.</p>
<h3>Predefined Character Classes (Meta-Characters)</h3>
<p>These are characters with special meaning. They represent a short form of defining character classes. Let's list them and what they stand for.</p>
<table>
	<tr><th>Class</th><th>What it does</th></tr>
	<tbody>
	<tr><td>\w</td><td>Matches any word character a to z, A to Z, 0 to 9 and underscore. Same as <strong>[a-zA-Z_0-9]</strong></td></tr>
	<tr><td>\W</td><td>Matches any non-word character. Same as <strong>[^a-zA-Z_0-9]</strong></td></tr>
	<tr><td><strong>.</strong></td><td>Matches any single character except a line break <strong>\n</strong></td></tr>
	<tr><td>\d</td><td>Matches any digit character. Same as <strong>[0-9]</strong></td></tr>
	<tr><td>\D</td><td>Matches any non-digit character. Same as <strong>[^0-9]</strong></td></tr>
	<tr><td>\s</td><td>Matches any whitespace character including space, tab, newline or carriage return. Same as <strong>[ \t\n\r]</strong></td></tr>
	<tr><td>\S</td><td>Matches any non-whitespace character. Same as <strong>[^ \t\n\r]</strong></td></tr>
	</tbody>
</table>
<p>Let's look at examples that use these predifined character classes. Evaluate what the expression below would match before testing it.</p> 
<pre class="prettyprint linenums">
&lt;?php
	$txt = "PDA is an acronym for personal digital assistant \nPhD stands for Doctor of Philosopht \npH indicator \nHypertext Processor:PHP";
	$pattern = "/^PH.*/im";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found";// exactly 2 matches, which ones?
</pre>
<p>All the characters in the expression apart from the dot (.) and "m", have already been used elsewhere. So, what does the above expression mean. The caret (^) at the beginning indicates that for a match to occur PH must be starting the string. The dot (.) means that any single non-new line character can follow after PH. The asterisk (*) modifies the dot (.) and indicate that a match should occur whether the single character is present or not. Meaning, PH alone should also match. Then lastly, the "im" makes the whole expression case-insensitive and each new line is evaluated as a new string (multiline mode, "m").</p> <p>That's why we have used "\n" in the <em>$txt</em> string to be evaluated to indicate the beginning of a new line with no space at the beginning of the line. "PDA" did not match because the first two characters are PD, neither did PHP on the last line because it is located at the end of the line. What matched was "PhD" and "pH" according to the rules described in the regular expression. </p>
<p>Having known the usage of the dot (.) can you analyze what the following expression would match?</p>
<pre class="prettyprint linenums">
&lt;?php
	$txt = "  ";
	$pattern = "/^.{2}$/";
	$matches = preg_match_all($pattern, $txt, $array);
	echo $matches. " matches found";//1 match found.
</pre>
<p>The above regular expression will match a string with exactly two non-newline characters from beginning to end. They can be text (e.g. cc), digits (e.g. 23) or two whitespaces. In the above code we have used two spaces in the string to be matched, that's why there was a match. </p>
<p>Let's move on. Suppose we want to split a string using spaces. Then we would use <code>\s</code> predefined class and <code>preg_split()</code> to plit words using the spaces and list them using a loop.</p>
<pre class="prettyprint linenums">
&lt;?php
	$pattern = "/[\s,]+/";
	$txt = "Francis Kahindi, Lewis Ndai, Caro Sei";
	$names = preg_split($pattern, $txt);
	foreach($names as $name){
	echo $name . "&lt;br&gt;";
	}
</pre>
<p>In the above pattern we have also used a comma <code> , </code> because the names are delimited by commas, otherwise the expression would treat the commas as part of the first two lastnames. </p>
<h3>Word Boundary</h3>
<p>A word boundary character <code> \b </code> helps in searching for words that begin or end with a certain pattern. For example if we type the expression as <code> /\bcon/ </code> it will match all words that begin with "con" such as connect, constant, container e.t.c. If we instead type it as <code> /con\b/ </code> it will match words that end with "con" such as lexicon, unicon, beacon e.t.c. Typing the regexp as <code> /\bcon\b/ </code> will exactly match the word con. In the code below <code> preg_replace() </code> function to search for the word "sea" and replace it with "beach" while using <code>\b</code> word boundary in the regexp. Tweak the pattern and string to gain more understanding.</p>
<pre class="prettyprint linenums">
&lt;?php
	$string = "The sea shined under the sun and seasand";
	$pattern = "/\bsea/";
	$replacement = "beach";
	$new_string = preg_replace($pattern, $replacement, $string);
	echo $new_string;
</pre>
