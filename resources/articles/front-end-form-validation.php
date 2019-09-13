<h1>Form Validation: HTML Validation</h1>
<p>In this tutorial we are going to look at how we can validate a form before submission. Form validation is important because it's one of the ways to prevents bad guys from injecting malicious code into your server. There are three stages a form can be validated
before the contents are processed by ther server. 
<ul>
	<li>HTML validation</li>
	<li>JavaScript validation</li>
	<li>Server-side validation</li>
</ul> 
<p>The first two techniques are commonly called front-end validation, because the validation is done on the client browser before data is transmitted to the server. The third type of validation also known as back-end  validation, takes place on the server computer after the form has been submitted. </p>
<p>Form validation is not automatic, the developer has to take deliberate steps to ensure form data is safe to be handled by the server. That doesn't mean that back-end validation has less importance, to the contrary it is the most important. If the first two methods fail, the server-side validation is the last resort. </p>
<p>However, relying solely on the server to validation user input can overwork the server and slow other critcal processes, especially in a busy environment. This is because when the form has errors, the server will detect and sent it back to the user for correction. The user willl notice that the form had errors, hence will correct them and resend the form. If the form still has errors the server will again send the form for correction. If this back and forth are too many, the server performance can go down due to the extra load. For this reason, form validation should start at the browser level and scale up to the server. In this tutorial we will use the features provided by HTML5 to carry out form validation at the browser level.</p>
<p>Let's begin with creating a form with five input fields: username, email, password, telephone and textarea. Or just copy the code below into your code editer and Save the file as <code>registration.html</code></p>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." required&gt;
	&lt;label for="email"&gt;Email:&lt;/label&gt;
	&lt;input type="email" name="email" maxlength="20" placeholder="Email..." required&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required&gt;
	&lt;label for="password"&gt;Password&lt;/label&gt;
	&lt;input type="password" name="password" placeholder="Password..." required&gt;
	&lt;label for="comment"&gt;Comment&lt;/label&gt;
	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required&gt;&lt;/textarea&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
&lt;/form&gt;
</pre>
<p>Before we explain the attributes let's style the form with some css to make it look decent. Copy the following styles into the head section of the <code> registration.html </code> html document and save the changes.</p>
<pre class="prettyprint linenums">
&lt;style&gt;
	form{
		width:25%;
		margin:40px auto;
		background: rgb(230, 230, 230)
	}
	input, label{
		display:block;
		width:80%;
		margin-left:20px;
		padding:10px 0;
	}
	textarea{
		width:80%;
		margin-left:20px;
	}
	input[type="submit"]{
		margin:20px;
		background:rgb(50,100,230);
	}
&lt;/style&gt;
</pre>
<p>If you refresh the browser page this time the form will look better. Now let's explain the attributes used in the form. The <code> placeholder="" </code> helps to lead the user where to type the values. Older browsers prior HTML5, However, do not support the attribute and will not display it. Using labels, therefore, becomes necessary if you think your form will used with older browsers. For browsers that support HTML5, placeholders can be used in place of labels. </p>
<p>The <code> maxlength="" </code> is a way of limiting the user the number of characters they can enter in that field. This way the user cannot exceed the number of characters you expect. Two things you should note though: One <code> maxlength </code> does not give feedback to the user the number of characters expected. Two, if the length is not chosen carefully, it may restrict users unnecessarily and annoy them. If that is a business form it can impact the business negatively. </p>
<p>The <code> type="" </code>attribute is very important because for example <code> email </code> input will  only accept valid email addresses. In the case of type <code>telephone</code>, only numbers and the (+) symbol for country code will be accepted. If any input in the form applies the <code> required </code> attribute, that field must be filled, otherwise the form will not submit. Different browsers have their own way of highlighting required fields if left blank. Deliberately mess around with these attributes and see how your form responds. </p>
<p>There is <code> pattern </code> attribute we have not used in the form so far. The <code> pattern </code> is actually a browser validation technique. When used, the field data must match a pattern of characters defined by an expression called <em>regular expression</em>. This attribute can be used with <code> text </code>, <code> tel </code>, <code> date </code>, <code> email </code>, <code> password </code>, <code> url </code> and <code> search </code> input types.</p>
<h2>HTML5 Form Validation Using Regular Expressions</h2>
<p>We are going to update the form with the <code> pattern </code> attribute for each input we have used. The <code>pattern</code> attribute actually evaluates the input value using an expression called <em> regular expression</em> for a match. So, in essence you define a rule on the type of characters that should be allowed in the input, without which they will be rejected. If you are not familiar with regular expressions you can check <a href="post.html.php?id=3">Regular Expressions</a>, because we will still use them in JavaScript and PHP. As for now we are going to use the ones that suit our purpose and explain what they stand for. </p>
<p>A global <code>title</code> attribute can be used along with the <code>pattern</code> attribute to guide the user what is expected of them when filling the input field.</p>

<h3>Example 1</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required&gt;
&lt;/form&gt;
</pre>
<p>The pattern above allows one or more alphanumeric character a-z0-9 and underscore. That's what <code> \w </code> stands for. The <code> + </code> allows at least one of the characters mentioned in the field. The number of characters in the field can also be restricted by using using braces <code>{}</code>. <code> "\w{3,}" </code> allows three or more characters, "\w{3,7}" restricts between three and seven character and  <code> "\w{,7}" </code> allows at most seven characters in the field.</p>

<p>This time let's try to validate a telephone field. Telephone number convention vary from country to country but we expect a country code that starts with a <code> + </code> symbol. If the country code is a three-digit number, we can take care of that by starting the expression with the expression <code> "\+[0-9]{3}" </code>. We have used character class defined by <code>[ ]</code> for the character range 0-9. This means "+" must start then followed by exactly any three digits between 0 and 9. Next, we want a hyphen "-" to connect the country code and the telephone number of nine digits. So, the complete expression looks like the one below:</p>
<h3>Example 2</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="text" name="tel" placeholder="Phone number..." pattern="\+[0-9]{3}-[0-9]{9}" title="Tel format: +XXX-XXXXXXXXX" required&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
	&lt;/form&gt;
</pre>
<p>Notice that we have used type="text" attribute instead of "tel" but have made the field to accept only numbers save " + " symbol. Take caution when restricting telephone numbers especially, if the form is for global audience, because of the countries' standards variations mentioned ealier. It would suffice to use the attribute type="tel" to make sure it's only numbers that will go in to that field.</p>
<p>Validating an email address using a regular expression is a little abit complex, because of the mandatory characters that a valid email should have, but if you picked something from the emmediate example above, you can build it piece meal. The expression in the example below matches an email in an input type of text.</P>
<h3>Example 3</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	E-mail: &lt;input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address."&gt; 
&lt;/form&gt;
</pre>
<p>Note: I have changed the input type from email to text to be able to test the validation properly. The pattern above means that the email address can begin with one or more <em> alphanumeric characters (a-z or 0-9)</em>. One or more <em>. _ % + -</em> characters followed by a mandatory <em>@</em>. After the <em>@</em> one or more alphanumeric characters including a dot (.) and - can follow. Finally, a mandatory dot(.) followed by at least two letter characters. The email in this case must be typed in lowercase letters and only the characters listed can be used in the email. It may not be perfect than the attribute type="email" but it ensures no illegal characters can be submitted with the form.</p>
<p>Let's build an expression to validate passwords. Many establishements that store sensitive information devise various password policies in the quest to safeguard access to that information. As much as the requirement to mix uppercase, lowercase, numbers and symbols makes the password strong and harder to crack, this practice has proved to be counter productive. Instead many companies prefer to use strong encryption algorithms at the back-end where the passwords are at more risk of being stolen than the front-end. Hence, it's not a good idea to restict the users too much to a point they may feel you are panalizing them for using your form.</p>
<h3>Example 4</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	Password: &lt;input type="password" name="pw" pattern=".{6,}" title="Six or more characters"&gt;
&lt;/form&gt;
</pre>
<P>The pattern means that the user must type six or more characters for password, otherwise the form will not submit. The dot (<code>.</code>) stands for any charachter except new line character.</p>
<p>So, let's have the whole form</p>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for="username">Username:&lt;/label&gt;
	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required&gt;
	&lt;label for="email"&gt;Email:&lt;/label&gt;
	&lt;input type="email" name="email" maxlength="20" placeholder="Email..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address" required&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required&gt;
	&lt;label for="password"&gt;Password&lt;/label&gt;
	&lt;input type="password" name="password" placeholder="Password..." pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6" required&gt;
	&lt;label for="comment"&gt;Comment&lt;/label&gt;
	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required>&lt;/textarea&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
&lt;/form&gt;
</pre>
<p>The <code>title</code> attribute explains what is expected in the field and it's exactly how the browser will display it, if the user messes with it.</p>
<p>Notice that the <code>required</code> attribute is still there because when the user clicks <code>submit</code> button, the browser first checks the required fields are not blank.</p>
<p>Finally, the complete registration.html code is given below. </p>
<pre class="prettyprint linenums">
&lt;! DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
&lt;meta charset="UTF-8"&gt;
&lt;style&gt;
	form{
		width:25%;
		margin:40px auto;
		background: rgb(230, 230, 230)
	}
	input, label{
		display:block;
		width:80%;
		margin-left:20px;
		padding:10px 0;
	}
	textarea{
		width:80%;
		margin-left:20px;
	}
	input[type="submit"]{
		margin:20px;
		background:rgb(50,100,230);
	}
&lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;	
    &lt;form method="POST" action=""&gt;
    	&lt;label for="username"&gt;Username:&lt;/label&gt;
    	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required&gt;
    	&lt;label for="email"&gt;Email:&lt;/label&gt;
    	&lt;input type="email" name="email" maxlength="20" placeholder="Email..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address" required&gt;
    	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
    	&lt;input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required&gt;
    	&lt;label for="password"&gt;Password&lt;/label&gt;
    	&lt;input type="password" name="password" placeholder="Password..." pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6" required&gt;
    	&lt;label for="comment" &gt;Comment&lt;/label&gt;
    	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required&gt;&lt;/textarea&gt;
    	&lt;input type="submit" name="submit" value="Submit"&gt;
    &lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>