<h1>Form Validation: HTML Validation</h1>
<p>In this tutorial we are going to look at how we can validate a form before submission.
Form validation is important because it's one of the ways that prevents unscrupulous folks from 
injecting malicious code into your server. There are three stages that a form can be validated
before the contents are processed by ther server. 
<ul>
	<li>HTML validation</li>
	<li>JavaScript validation</li>
	<li>Server-side validation</li>
</ul> 
The first two techniques are commonly called front-end validation, because the validation is done on the client browser before data is transmitted to the server. The third type of validation also known as back-end  validation, takes place on the server computer after the form has been submitted. </p>
<p>Form validation is not automatic, the developer has to take deliberate steps to ensure form data is safe to be handled by the server. It is my personal view that back-end validation is the most important because it is the last resort incase the first two fail. </p>
<p>However, relying only on the server-side validation can overwork the server and slow other critcal processes, especially in a busy environment. This is because any errors in the form have to be sent back to the client for correction instead of being processed once. For this reason, we are going to start with HTML5 form validation in this tutorial.</p>
<p>Let's begin with creating a form with five input fields: username, email, password, telephone and textarea. Or just copy the code below into your code editer and Save the form as <code>registration.html</code></p>
<pre class="prettyprint linenums">
<code>
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." required&gt;
	&lt;label for="email"&gt;Email:&lt;/label&gt;
	&lt;input type="email" name="email" maxlength="20" placeholder="Email..." required&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required&gt;
	&lt;label for="password"&gt;Password&lt;/label&gt;
	&lt;input type="password" name="password" placeholder="Password..." required&gt;
	&lt;label for="comment" &gt;Comment&lt;/label&gt;
	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required&gt;&lt;/textarea&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
&lt;/form&gt;
</code>
</pre>
<p>Let's explain the attributes used in the form. <code>placeholder=""</code> is just a hint to the user where to type the values or how they should be entered. However, older browsers prior HTML5 do not support the attribute and will not display it. Using labels, therefore, becomes necessary if you think your form will used on old browsers. But, for browsers that support HTML5, placeholders can be used in place of labels. </p>
<p>The <code>maxlength=""</code> is a way of limiting the user from inputing more than what you expect. It sort of restricts the user from exceeding the number of characters you expect. Two things you should note though: one <code>maxlength</code> does not give feedback to the user that the input cannot accept more than what is being put in. Two, if the length is not chosen carefully, it may restrict users unnecessarily and annoy them. That can impact you negatively. </p>
<p>The <code>type=""</code>attribute is very important because for example <code>email</code> input will  only accept valid email format. The case of <code>telephone</code>, only numbers and the (+)sign for country code will be accepted. If any input uses <code>required</code> attribute, that field can not be left blank, otherwise the form will not submit. Different browsers have their own way of highlighting required field that are left blank. Deliberately mess around with these attributes and see how your form responds. </p>
<p>There is another attribute <code>pattern</code> we have not used in the form so far. The <code>pattern</code> is actually a browser validation technique bacause the form will not be submitted to the server unless the pattern matches the one placed on the input field. This attribute works with <code>text</code>, <code>tel</code>, <code>date</code>, <code>email</code>, <code>password</code>, <code>url</code> and <code>search</code> input types.</p>
<h2>HTML5 Form Validation Using Regular Expressions</h2>
<p>We are going to update the form with the <code>pattern</code> attribute for each input we have used. The <code>pattern</code> attribute actually evaluates an expression called <em> regular expression</em> for a match. So, you define a rule on the type of characters and how they how they should entered, without which they will be rejected. For those who are not familiar with regular expressions I intend to post a tutorial on that in future, because we will still use them in JavaScript and PHP. As for now we are going to use the ones that suit our purpose and explain what they stand for. </p>
<p>A global <code>title</code> attribute can be used along with the <code>pattern</code> attribute to guide the user what is expected of them when filling the field.</p>
<h3>Example 1</h3>
<pre class="prettyprint linenums">
<code>	
&lt;form method="POST" action=""&gt;
	Password: &lt;input type="password" name="pw" pattern=".{6,}" title="Six or more characters"&gt;
&lt;/form&gt;
</code>
</pre>
<P>The pattern means the user must type six or more characters for password, otherwise the form will not submit.</P>
<h3>Example 2</h3>
<pre class="prettyprint linenums">
<code>
&lt;form method="POST" action=""&gt;
	E-mail: &lt;input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address."&gt; 
&lt;/form&gt;
</code>
</pre>
<p>The pattern expresseion means the email address must be start with any <em>characters a-z or 0-9</em> followed by an <em>@</em> then more characters , then followed by a<code> <em>'.'</em></code> then at least two characters</p>
<p>So, let's have the whole form</p>
<pre class="prettyprint linenums">
<code>
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." pattern="/^[w]+$/" title="Type only letters, numbers and underscore with no space" required&gt;
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
</code>
</pre>
<p>The <code>title</code> attribute explains what is expected in the field and it's exactly how the browser will display it, if the user messes with it.</p>
<p>Notice that the <code>required</code> attribute is still there because when the user clicks <code>submit</code> button, the browser first checks the required fields are not blank.</p>
<p>If you display the form right now it won't look appealiing, so we are goind to style it up abit with some css.</p>
