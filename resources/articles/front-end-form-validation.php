<h1>Front End Form Validation Pt1</h1>
<p>In this tutorial we are going to look at how we can validate a form before submission.
Form validation is important because it's one of the ways that prevents unscrupulous fox from 
injecting malicious code into the server. There are three stages that a form can be validated
before it's contents are processed by ther server. 
<ul>
	<li>HTML5 validation</li>
	<li>JavaScript validation</li>
	<li>Server-side validation</li>
</ul> 
The first two techniques are commonly called front-end validation, because the validation is done and the client browser before the form data is transmitted to the server. The third type of validation is also known as back-end  validation. This validation takes place on the server after the form has been submitted. </p>
<p>Form validation is not automatic, the developer has to take deliberate stepd to make sure the form data is safe to be handled by the server, otherwise some hacker may compromise the server's integrity and steal sensitive information or corrupt data. It is personal view that back-end validation is the most important because it is the last resort if the first two techniques fail. And they can be made to fail. </p>
<p>However, relying only on the server validation can slow other server critcal processes, especially for a busy site. This is because any errors in the form have to be sent back to the client for correction instead of the form data taken for processing. For this reason, we are going to start with HTML5 form validation in this tutorial.</p>
<p>Let's begin with creating a form with five input fields: username, email, password, telephone and textarea. Save the form as <code>registration.html</code></p>
<pre>
<code>
	&lt;form method=&quot;POST&quot; action=&quot;&quot;&gt;
		&lt;label for=&quot;username&quot;&gt;Username:&lt;/label&gt;
		&lt;input type=&quot;text&quot; name=&quot;username&quot; maxlength=&quot;15&quot; placeholder=&quot;Username ...&quot; required&gt;
		&lt;label for=&quot;email&quot;&gt;Email:&lt;/label&gt;
		&lt;input type=&quot;email&quot; name=&quot;email&quot; maxlength=&quot;20&quot; placeholder=&quot;Email...&quot; required&gt;
		&lt;label for =&quot;tel&quot;&gt;Telephone&lt;/label&gt;
		&lt;input type=&quot;tel&quot; name=&quot;tel&quot; maxlength=&quot;9&quot;placeholder=&quot;Phone number...&quot; required&gt;
		&lt;label for=&quot;password&quot;&gt;Password&lt;/label&gt;
		&lt;input type=&quot;password&quot; name=&quot;password&quot; placeholder=&quot;Password...&quot; required&gt;
		&lt;label for=&quot;comment&quot; &gt;Comment&lt;/label&gt;
		&lt;textarea name=&quot;comment&quot; col=30 rows=5 placeholder=&quot;Type your text here...&quot; required&gt;&lt;/textarea&gt;
		&lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;Submit&quot;&gt;
	&lt;/form&gt;
</code>
</pre>
<p>Let's explain the attributes used in the form. <code>placeholder=""</code> is just a guide to the user where to type the values. For older browsers before HTML3.0 it is not supported and will not display hence using the labels is necessary. For browsers that support HTML5, placeholders can be used instead of labels. </p>
<p>The <code>maxlength=""</code> is a way of limiting the user from inputing more than what you expect. So, it be used to restrict the user and maybe a hacker from injecting code. Two things you should note though: one <code>maxlength</code> does not give feedback to the user that the input cannot accept more than what is being put in. Two, if the length is not chosen careful it may restrict users unnecessarily and annoy them. That can impact you negatively. </p>
<p>The <code>type=""</code>attribute is very important because for <code>email</code> the input will accept only valid email format, for <code>telephone</code> only numbers and the (+)sign for country code. So there is validation there. <code>required</code> attribute stops the input from being submitted while blank and the user will be given a feedback that content is required in the fields that are empty. Every browser implementation has their own way of giving the feeback.</p>
<p>There is another attribute <code>pattern</code> we have not used in the form so far. The <code>pattern</code> is actually a browser validation technique bacause the form will not be submitted to the server unless the pattern matches the one placed on the input field. It works with <code>text</code>, <code>tel</code>, <code>date</code>, <code>email</code>, <code>password</code>, <code>url</code> and <code>search</code> input types.</p>
<h2>HTML Form Validation Using Regular Expressions</h2>
<p>We are going to update the form with the <code>pattern</code> attribute for each input we have used. The <code>pattern</code> attribute actually evaluates an expression called <em> regular expression</em> for a match. For those who are not familiar with regular expressions I intend to post a tutorial on that topic next because we will still use them in JavaScript and PHP. As for now we are going to use the ones that suit our purpose and explain what they stand for. </p>
<p>A global <code>title</code> attribute can be used to guided the user what is expected of them in the field they are filling in.</p>
<h3>Example 1</h3>
<pre>
	<code>	
	&lt;form method=&quot;POST&quot; action=&quot;&quot;&gt;
		Password: &lt;input type=&quot;password&quot; name=&quot;pw&quot; pattern=&quot;.{6,}&quot; title=&quot;Six or more characters&quot;&gt;
	&lt;/form&gt;
	</code>
</pre>
<P>It the patterns means the user must type more six or more character for password, otherwise the form will not submit.</P>
<h3>Example 2</h3>
<pre>
	<code>
	&lt;form method=&quot;POST&quot; action=&quot;&quot;&gt;
		E-mail: &lt;input type=&quot;email&quot; name=&quot;email&quot; pattern=&quot;[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$&quot; title=&quot;Type a valid email address.&quot;&gt; 
	&lt;/form&gt;
	</code>
</pre>
<p>The pattern expresseion means the email address must be start with any <em>characters a-z or 0-9</em> followed by an <em>@</em> then more characters , then followed by a <em>'.'</em> then at least two characters</p>
<p>So, let's have the whole form</p>
<pre>
	<code>
	&lt;form method=&quot;POST&quot; action=&quot;&quot;&gt;
		&lt;label for=&quot;username&quot;&gt;Username:&lt;/label&gt;
		&lt;input type=&quot;text&quot; name=&quot;username&quot; maxlength=&quot;15&quot; placeholder=&quot;Username ...&quot; pattern=&quot;/^[w]+$/&quot; title=&quot;Type only letters, numbers and underscore with no space&quot; required&gt;
		&lt;label for=&quot;email&quot;&gt;Email:&lt;/label&gt;
		&lt;input type=&quot;email&quot; name=&quot;email&quot; maxlength=&quot;20&quot; placeholder=&quot;Email...&quot; pattern=&quot;[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$&quot; title=&quot;Type a valid email address&quot; required&gt;
		&lt;label for =&quot;tel&quot;&gt;Telephone&lt;/label&gt;
		&lt;input type=&quot;tel&quot; name=&quot;tel&quot; maxlength=&quot;9&quot;placeholder=&quot;Phone number...&quot; required&gt;
		&lt;label for=&quot;password&quot;&gt;Password&lt;/label&gt;
		&lt;input type=&quot;password&quot; name=&quot;password&quot; placeholder=&quot;Password...&quot; pattern=&quot;(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}&quot; title=&quot;Must have at least one number and one uppercase and lowercase letter, and at least 6&quot; required&gt;
		&lt;label for=&quot;comment&quot; &gt;Comment&lt;/label&gt;
		&lt;textarea name=&quot;comment&quot; col=30 rows=5 placeholder=&quot;Type your text here...&quot; required&gt;&lt;/textarea&gt;
		&lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;Submit&quot;&gt;
	&lt;/form&gt;
	</code>
</pre>
<p>The <code>title</code> attribute explains what is expected to be input by the user and it's exactyl how the browser will display it if they mess with it.</p>
<p>Note: The <code>required</code> attribute is still there because when the user clicks <code>submit</code> button the browser first checks the required fields are not blank.</p>
<p>If you display the form right now it won't look appealiing, so we are goind to style it up abit wit css.</p>
