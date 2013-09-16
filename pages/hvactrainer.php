<!DOCTYPE HTML>

<html lang="en-US">
<head>
	<title>Matthew Ross</title>
	<?php include("../php/head.php"); ?>
	<script>


	</script>
	
	
	<?php
	
	
	
	?>
	
</head>
<body>
	<?php include("../php/header.php"); ?>

	<div id='content_container'>
		<div class='content_title'>hvactrainerpro.com</div>
		<div class=''>
			<p>Hvactrainerpro.com is a simulation of the electrical circuits found in heating and cooling systems. This was a very fun project, because it was the first time I developed a web program utilized the latest web technologies. HTML5 technologies, like the canvas element are heavily used. A javascript powered canvas library named 'kineticjs' was used to animate the canvas and bind click events to lines drawn on the canvas.</p>
			<p>The result of this project is a very accurate reproduction of an actual electrical circuit found in HVAC equipment. The idea is that this project could be easily expanded to simulate many different types of furnaces, as an immersive HVAC educational tool.</p>
			<p>This website is live at <a href='http://www.hvactrainerpro.com' target='_blank'>hvactrainerpro.com</a> - Feel free to visit on a desktop or tablet computer! (This application has not been thoroughly tested for cross browser/device compatibility. User experience may vary).</p>
		</div>
		<div class='pane-wrap-full'>
			<div class='pane-top'>Gameplay</div>
			<div class='pane'>
				<div id='1ipcW0JIN7g' class='vid-click fright'>
					<img class='vid-thumb' src='../images/hvactrainer_thumb.png'	/>
					<p class='vid-expand'>Promotional Video - Click to play</p>
				</div>
				<p>The purpose of this game is to correctly diagnose the problem in the electrical circuit. A multimeter is used to check volts, amps, resistance, and ferads. The electrical circuit behaves differently based on the 'mode' that the thermostat is set to. The user must first identify which part of the system has failed (if any), and then correctly diagnose the source of the problem.</p>
				<p>The user experience is simple. The page is full of grey 'contact' points. When a user clicks on a 'contact' point, one lead from the multimeter is placed there. The next 'contact' click will place the other multimeter lead at that point, and a reading will be produced.</p>
				<p>Users can tell if a piece of equipment is running be either taking an amp draw, or by obersving the animated visual cues (ie the heat strips will glow red when in heat mode)</p>
				<p>Once the user has decided what the correct diagnosis is, they must choose from a large list of predefined answers. The list is long enough to prevent users from simply guessing until they arrive at the correct answer. If the answer is correct, the next problem is unlocked. If the answer is incorrect, then the user must retry, and their 'attempt-count' is raised by one.</p>
				<p>This game is still in an early beta phase. There are still many unpolished corners, designs left undone, and concepts not yet developed. Some examples of features to come from this project include tools for diagnosing refrigeration problems, and tracking tools to chart performance.</p>
			</div>
		</div>
		<div class='pane-wrap-full'>
			<div class='pane-top'>Problem Solving <span id='slider1'></span></div>
			<div class='pane padding-zero'>
				<div class='arrow-left'>
					<div class='triangle-left'></div>
				</div>
				<div class='slide active-slide'>
					<div id='hvactrainerpro.png' class='ex-click fright'>
						<img class='thumb' src='../images/hvactrainerpro.png'	/>
						<p class='expand'>Click to expand</p>
					</div>
					<p>In this section, I will present a real problem that I faced while coding hvactrainerpro. It is intended to demonstrate my problem solving abilities, and coding habits.</p>
					<p>Displayed to the right is a screenshot of hvactrainerpro. The problem that I faced was that while the multimeter was in "amp" mode it was difficult to hover the mouse over the skinny wire to register the 'click'. I did not want to make the wires any thicker, because it would compromise the aestheics of the page causing it to look cluttered and full.</p>
					<p>A secondary goal of this challenge, was to develop a way to easily change and create new wires. This is essential to building a scalable web-application, as the wires will be used on any future furnaces that are built.</p>
					<p>With these goals in mind, I developed a way to minimize the effort it takes to modify wires, and even leaves an opportunity to create a graphic, web-based solution to easily prototype new wires.</p>
					<p>Click on the arrow to your right to advance to the next slide.</p>
				</div>
				<div class='slide'>
					<p>The wires are drawn using a javascript library called 'kineticjs' that is desgined to interact with the canvas feature. Below is the code that draws the basic wires that we see. A click event is attached to the lines that calls the 'checkAmps' function and passes the id of the line. Finally, the line is added to the layer.</p>
					<div class='code-holder-full fleft'>
						<script type="syntaxhighlighter" class="brush: js">

						<![CDATA[
							  // creates a new layer
							  var layer = new Kinetic.Layer();

							  // draws a blackLine
							  var blackLine = new Kinetic.Line({
								id: 'b1',
								name: 'wireclick',
								points: [0, 245, 25, 245],
								stroke: black,
								strokeWidth: 8,
								lineCap: 'round',
								lineJoin: 'round'
							  });
							  
							  // bind click event
							  blackLine.on('click', function () { check_amps(b1);});
							  
							  // adds blackLine to layer
							  layer.add(blackLine);
						]]>
					
						</script>
					</div>
					<script type='text/javascript'>
					
					
					</script>
				</div>
				<div class='slide'>
				
					<div class='code-holder fleft'>
						<script type="syntaxhighlighter" class="brush: js">

						<![CDATA[
							//line points
							bl_points = [0, 245, 25, 245];
							
							//black line
							var blackLine = new Kinetic.Line({
								points: bl_points,
								stroke: black,
								strokeWidth: 5,
								lineCap: 'round',
								lineJoin: 'round'
							});
							
							//black line hover
							var blackLine_red = new Kinetic.Line({
								id: 'b1',
								name: 'wireclick',
								points: bl_points,
								stroke: red,
								strokeWidth: 20,
								lineCap: 'round',
								lineJoin: 'round',
								opacity: 0
							});
							
							//adds wires to stage
							layer.add(blackLine);
							layer.add(blackLine_red);
							
							//assigns hover and click to wires
							ac_lines = stage.get('.wireclick');
							ac_lines.each(function (line) {
								line.on('mouseover', wire_mouseover);
								line.on('mouseout', wire_mouseout);
								line.on('click', function () { check_amps(this.getId());});
							});]]>
					
						</script>
					</div>
					
						<p>As I said before, it would not be acceptable to increase the width of the wires. However, the experience of trying to click the wires was terrible, especially on a tablet!</p>
						<p>My solution was to create a second invisible line to lay on the top of each wire. This second line would have a longer stroke-width, and would appear on 'mouseover' above a single wire. Because the second wire sits on top of the original, it is also where the click event will be registered.</p>
						<p>The second line has an initial opacity of 0. When the mouse is hovers over the larger, invisible second line, the opacity changes to .8 and the red background is visible. This tells the user that the wire is clickable.</p>
						<p>Once the second wire is clicked, the checkAmps function is run with the 'id' as the parameter.</p>
						<p>This solution as it sits works well. However this is tiresome and clumsy coding, and would require me to do a lot of typing anytime a line was added or removed.</p>
						<p>On the next slide, I discuss how the coding was simplified and streamlined for future development.</p>
					
				</div>
				<div class='slide'>
					
					
						<p>It was at this point that I knew I would have to move the data about my wires to an external xml file to simplify coding and avoid repetitive typing.</p>
					<div class='code-holder-full fleft'>
						<script type="syntaxhighlighter" class="brush: xml">

						<![CDATA[
						
						<bl_points lineid = 'ac_b1' points="0, 245, 25, 245" color = 'black' stroke ='8' />]]>
					
						</script>
					</div>	
						
						
						<p>All of the wire attributes that could be consided 'variables', were assigned as attributes of an xml node. Next a loop was built that found all wire nodes, and created lines based on the attributes provided. The advantage to coding this way, is that I can simply add one xml line to create a whole new wire.</p>
						<p>The full code for the wires is on the next slide. It is simple, scalable, and functionable in this application. It demonstrates my ability to approach detailed problems, and develop a creative solution.</p>
				</div>
				<div class='slide'>
					<p class='bold'>Below is the final code that handles the xml data and draws the wires.</p>
					<div class='code-holder-full fleft'>
						<script type="syntaxhighlighter" class="brush: js">

						<![CDATA[
						//access the correct xml node
						wireroot = root.getElementsByTagName("draw_wires")[0];
						acwire = wireroot.getElementsByTagName("ac_wires")[0].childNodes;
	 
						//a loop that will cycle through all childNodes of ac_wires
						for (i=0;i<acwire.length;i++)	{
						if (acwire[i].nodeType==1) {
							//sets xml wire attributes to variables
							lineid = acwire[i].getAttributeNode("lineid").nodeValue;
							wirepoints = (acwire[i].getAttributeNode("points").nodeValue).split(", ");
							tmpcolor = acwire[i].getAttributeNode("color").nodeValue;
							stroke = acwire[i].getAttributeNode("stroke").nodeValue;

							//creates the colored, always visible line
							namelines[i] = new Kinetic.Line({
							points: wirepoints,
							stroke: color,
							strokeWidth: stroke,
							lineCap: 'round',
							lineJoin: 'round'
							});
							
							//creates the red line that appears on hover
							redlines[i] = new Kinetic.Line({
							id : lineid,
							name: 'wireclick',
							points: wirepoints,
							stroke: red,
							strokeWidth: 20,
							lineCap: 'round',
							lineJoin: 'round',
							opacity:0
							});
							
							//adds newly created lines to the layer
							layer.add(namelines[i]);
							layer.add(redlines[i]);

							} 
						}
						]]>
					
						</script>						
						
					</div>
				
				</div>
				<div class='arrow-right'>
					<div class='triangle-right'></div>
				</div>
				
			</div>
		</div>
	</div>
	<div class='footer'>
	</div>
</div>
</body>
</html>