<?php
/*	
	$str = 'Abourizk S., (2000). Application Framework for Development of Simulation
Tools. Retrieved on July 2000 from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools

Adam, A., (2008). Implementing electronic document and record
management systems. Retrieved from http://dergipark.gov.tr/download/article-file/358089.

Armstrong, JS., (2001). Modeling the Theory: Philosophical Basis. Retrieved
from http://shodhganga.inflibnet.ac.in/bitstream/10603/2707/17/17_chapter%206.pdf

Bigirimana S., Jagero N., & Chizema P., (2015). An Assessment of the
Effectiveness of Electronic Records Management. Retrieved from https://www.researchgate.net/publication/281332642_An_Assessment_of_the_Effectiveness_of_Electronic_Records_Management_at_Africa_University_Mutare_Zimbabwe.

Bongor et al., (2009). Cognitive Computing: Where Big Data Is Driving Us.
Retrieved from https://www.researchgate.net/figure/SUS-scale-from-Bangor-et-al-2009_fig8_314119509

Bunawan, A., (2013). Enhancing the Efficiency of Managing Electronic
Records among the Record Management Practitioner by Using an Appropriate Electronic Records Management System (ERMS). Retrieved from http://www.academia.edu/10630737/Enhancing_the_Efficiency_of_Managing_Electronic_Records_among_the_Record_Management_Practitioner_by_Using_an_Appropriate_Electronic_Records_Management_System_ERMS_

Giandon, A., Junior R., & Scheer, S., (2002). Implementing Electronic
Document Management System for a Lean Design Process. Retrieved from https://www.researchgate.net/publication/228789828_Implementing_electronic_document_management_system_for_the_Lean_design_process.

Johnston G.P. & Bowen D.V., (2005). The benefits of electronic records
management systems: a general review of published and some unpublished cases, Records Management Journal, Vol. 15 (3), 131-140.

Kelemen, R., & Mekovec, R., (2007). Document Management System-A Case
Study of Varaždin County. Retrieved from https://bib.irb.hr/datoteka/345603.Kelemen-Mekovec_-_DMS_-_A_Case_Study_of_Varazdin_Counti_pp41-46s.pdf

Lavrakas, P., (2008). Random Sampling. Retrieved from
http://methods.sagepub.com/reference/encyclopedia-of-survey-research-methods/n440.xml

Richey, R., (1996). Developmental Research: The Definition and Scope.
Retrieved from https://eric.ed.gov/?id=ED373753
';


 $reg_exURL = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

 if(preg_match($reg_exURL, $str, $url)){
 	$final = preg_replace($reg_exURL, "<a href=" . $url[0] . ">$url[0]</a>", $str);
 }


echo  nl2br($final);
*/



?>

<!DOCTYPE html>
<html>
<head>
	<title>ggg</title>
</head>
<body>
	<form action="save.php" method="POST">
		<textarea name="refrences" cols="100" rows="10" id="refrences">'Abourizk S., (2000). Application Framework for Development of Simulation
Tools. Retrieved on July 2000 from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools

Adam, A., (2008). Implementing electronic document and record
management systems. Retrieved from http://dergipark.gov.tr/download/article-file/358089.

Armstrong, JS., (2001). Modeling the Theory: Philosophical Basis. Retrieved
from http://shodhganga.inflibnet.ac.in/bitstream/10603/2707/17/17_chapter%206.pdf

Bigirimana S., Jagero N., & Chizema P., (2015). An Assessment of the
Effectiveness of Electronic Records Management. Retrieved from https://www.researchgate.net/publication/281332642_An_Assessment_of_the_Effectiveness_of_Electronic_Records_Management_at_Africa_University_Mutare_Zimbabwe.

Bongor et al., (2009). Cognitive Computing: Where Big Data Is Driving Us.
Retrieved from https://www.researchgate.net/figure/SUS-scale-from-Bangor-et-al-2009_fig8_314119509

Bunawan, A., (2013). Enhancing the Efficiency of Managing Electronic
Records among the Record Management Practitioner by Using an Appropriate Electronic Records Management System (ERMS). Retrieved from http://www.academia.edu/10630737/Enhancing_the_Efficiency_of_Managing_Electronic_Records_among_the_Record_Management_Practitioner_by_Using_an_Appropriate_Electronic_Records_Management_System_ERMS_

Giandon, A., Junior R., & Scheer, S., (2002). Implementing Electronic
Document Management System for a Lean Design Process. Retrieved from https://www.researchgate.net/publication/228789828_Implementing_electronic_document_management_system_for_the_Lean_design_process.

Johnston G.P. & Bowen D.V., (2005). The benefits of electronic records
management systems: a general review of published and some unpublished cases, Records Management Journal, Vol. 15 (3), 131-140.

Kelemen, R., & Mekovec, R., (2007). Document Management System-A Case
Study of Varaždin County. Retrieved from https://bib.irb.hr/datoteka/345603.Kelemen-Mekovec_-_DMS_-_A_Case_Study_of_Varazdin_Counti_pp41-46s.pdf

Lavrakas, P., (2008). Random Sampling. Retrieved from
http://methods.sagepub.com/reference/encyclopedia-of-survey-research-methods/n440.xml

Richey, R., (1996). Developmental Research: The Definition and Scope.
Retrieved from https://eric.ed.gov/?id=ED373753</textarea>
<input type="submit" name="submit">
	</form>
</body>
</html>