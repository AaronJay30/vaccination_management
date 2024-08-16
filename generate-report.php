<?php
session_start();
@include 'include\config.php'; 
require('FPDF/fpdf.php');

class PDF_Sector extends FPDF{
	function Sector($xc, $yc, $r, $a, $b, $style='FD', $cw=true, $o=90)
	{
		$d0 = $a - $b;
		if($cw){
			$d = $b;
			$b = $o - $a;
			$a = $o - $d;
		}else{
			$b += $o;
			$a += $o;
		}
		while($a<0)
			$a += 360;
		while($a>360)
			$a -= 360;
		while($b<0)
			$b += 360;
		while($b>360)
			$b -= 360;
		if ($a > $b)
			$b += 360;
		$b = $b/360*2*M_PI;
		$a = $a/360*2*M_PI;
		$d = $b - $a;
		if ($d == 0 && $d0 != 0)
			$d = 2*M_PI;
		$k = $this->k;
		$hp = $this->h;
		if (sin($d/2))
			$MyArc = 4/3*(1-cos($d/2))/sin($d/2)*$r;
		else
			$MyArc = 0;
		//first put the center
		$this->_out(sprintf('%.2F %.2F m',($xc)*$k,($hp-$yc)*$k));
		//put the first point
		$this->_out(sprintf('%.2F %.2F l',($xc+$r*cos($a))*$k,(($hp-($yc-$r*sin($a)))*$k)));
		//draw the arc
		if ($d < M_PI/2){
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
		}else{
			$b = $a + $d/4;
			$MyArc = 4/3*(1-cos($d/8))/sin($d/8)*$r;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
			$a = $b;
			$b = $a + $d/4;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
			$a = $b;
			$b = $a + $d/4;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
			$a = $b;
			$b = $a + $d/4;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
		}
		//terminate drawing
		if($style=='F')
			$op='f';
		elseif($style=='FD' || $style=='DF')
			$op='b';
		else
			$op='s';
		$this->_out($op);
	}

	function _Arc($x1, $y1, $x2, $y2, $x3, $y3 )
	{
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
			$x1*$this->k,
			($h-$y1)*$this->k,
			$x2*$this->k,
			($h-$y2)*$this->k,
			$x3*$this->k,
			($h-$y3)*$this->k));
	}
}

class PDF_Diag extends PDF_Sector {
	var $legends;
	var $wLegend;
	var $sum;
	var $NbVal;

	function PieChart($w, $h, $data, $format, $colors=null){
		$this->SetFont('Times', '', 12);
		$this->SetLegends($data,$format);

		$XPage = $this->GetX();
		$YPage = $this->GetY();
		$margin = 2;
		$hLegend = 5;
		$radius = min($w - $margin * 4 - $hLegend - $this->wLegend, $h - $margin * 2);
		$radius = floor($radius / 2);
		$XDiag = $XPage + $margin + $radius;
		$YDiag = $YPage + $margin + $radius;
		if($colors == null) {
			for($i = 0; $i < $this->NbVal; $i++) {
				$gray = $i * intval(255 / $this->NbVal);
				$colors[$i] = array($gray,$gray,$gray);
			}
		}

		//Sectors
		$this->SetLineWidth(0.2);
		$angleStart = 0;
		$angleEnd = 0;
		$i = 0;
		foreach($data as $val) {
			$angle = ($val * 360) / doubleval($this->sum);
			if ($angle != 0) {
				$angleEnd = $angleStart + $angle;
				$this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
				$this->Sector($XDiag, $YDiag, $radius, $angleStart, $angleEnd);
				$angleStart += $angle;
			}
			$i++;
		}

		//Legends
		$this->SetFont('Times', '', 12);
		$x1 = $XPage + 2 * $radius + 4 * $margin;
		$x2 = $x1 + $hLegend + $margin;
		$y1 = $YDiag - $radius + (2 * $radius - $this->NbVal*($hLegend + $margin)) / 2;
		for($i=0; $i<$this->NbVal; $i++) {
			$this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
			$this->Rect($x1, $y1, $hLegend, $hLegend, 'DF');
			$this->SetXY($x2,$y1);
			$this->Cell(0,$hLegend,$this->legends[$i]);
			$y1+=$hLegend + $margin;
		}
	}

	function SetLegends($data, $format){
		$this->legends=array();
		$this->wLegend=0;
		$this->sum=array_sum($data);
		$this->NbVal=count($data);
		foreach($data as $l=>$val)
		{
			$p=sprintf('%.2f',$val/$this->sum*100).'%';
			$legend=str_replace(array('%l','%v','%p'),array($l,$val,$p),$format);
			$this->legends[]=$legend;
			$this->wLegend=max($this->GetStringWidth($legend),$this->wLegend);
		}
	}
}

class PDF_Rotate extends PDF_Diag{
    var $angle=0;

    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function _endpage()
    {
        if($this->angle!=0)
        {
            $this->angle=0;
            $this->_out('Q');
        }
        parent::_endpage();
    }
}

class PDF extends PDF_Rotate{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('image/OKLogo.png',10,6,30);
        $this->Image('image/depedLogo.png',170,6,30);
        // Arial bold 15
        $this->SetFont('Times','B',16);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,20,'Oceans of Knowledge High School',0,0,'C');
        $this->Ln(6);

        $this->Cell(80);
        $this->SetFont('Times','',12);
        $this->Cell(30,20,'email: oceansofknowledge3100@gmail.com',0,1,'C');
        $this->Line(10, 42, 210 - 10, 42);

        $this->SetFont('Arial','B',45);
        $this->SetTextColor(225,225,225);
        $this->RotatedText(15,240,'O C E A N S O F K N O W L E D G E',45);
        
        // Line break
        $this->Ln(10);


    }
	
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number

		date_default_timezone_set('Asia/Manila');

		$date = date("F d Y");

        $this->Cell(0,10,"(".$date.")",0,0,'L');
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }
}

// Instanciation of inherited class
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$check = explode(",",$_GET['fltrCheck']);

if ($check[0] != null){
    /*---------------VACCINATION SYSTEM-----------------*/

	$check = str_replace(","," , ",$_GET['fltrCheck']);

    if(strpos($check,"FVB") !== false){
        $check = str_replace("FVB","Fully Vaccinated with Booster",$check);
    }

    if(strpos($check,"FV") !== false){
        $check = str_replace("FV","Fully Vaccinated",$check);
    }

    if(strpos($check,"NV") !== false){
        $check = str_replace("NV","Not Vaccinated",$check);
    }

    if(strpos($check,"OD") !== false){
        $check = str_replace("OD","One Dose Vaccination",$check);
    }

    if(strpos($check,"HV") !== false){
        $check = str_replace("HV","Half Vaccinated",$check);
    }

	if(strpos($check,"7") !== false){
        $check = str_replace("7","Grade 7",$check);
    }
	
	if(strpos($check,"8") !== false){
        $check = str_replace("8","Grade 8",$check);
    }
	if(strpos($check,"9") !== false){
        $check = str_replace("9","Grade 9",$check);
    }
	if(strpos($check,"10") !== false){
        $check = str_replace("10","Grade 10",$check);
    }
	if(strpos($check,"11") !== false){
        $check = str_replace("11","Grade 11",$check);
    }
	if(strpos($check,"12") !== false){
        $check = str_replace("12","Grade 12",$check);
    }

	if(strpos($check,"1") !== false){
        $check = str_replace("1","Section 1",$check);
    }
	if(strpos($check,"2") !== false){
        $check = str_replace("2","Section 2",$check);
    }


	$confirmation = True;
} else{
    $check = "No filter";
	$confirmation = False;
}

/*---------------SQL STATEMENT-----------------*/
$sql = "SELECT COUNT(*) FROM user_vaccine";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$totalCount = $row['COUNT(*)'];
$count = $_GET['numData'];
$percentage = ($count/$totalCount)*100;
$percentage = round($percentage, 2);

$rest = $totalCount - $count;



if (!$confirmation){
	$data = array($check => $rest, "The rest of population" => $count);
} else{
	$data = array($check => $count, "The rest of population" => $rest);
}

$dateExplode = explode(",",$_GET['fltrDate']);

if($dateExplode[0] != null){
    $stime = strtotime($dateExplode[0]);
    $startDate = date("F d, Y", $stime);

    $etime = strtotime($dateExplode[1]);
    $endDate = date("F d, Y", $etime);
} else{
    $startDate = null;
    $endDate = null;
}


/*---------------TABLE-----------------*/
$pdf->ln(5);
$pdf->SetFont('Times','B',16);
$pdf->Cell(0,10,'GENERATED REPORT',0,0,'C');
$pdf->ln(20);


$pdf->SetFont('Times','B',12);
$pdf->SetFillColor(220,220,220);
$pdf->Cell(52, 8,"FILTERED BY: ", 1, 0, 'L', true);

$pdf->SetFont('Times','',12);
$pdf->Cell(0, 8,"  ".$check, 1, 1, 'L');


$pdf->SetFont('Times','B',12);
$pdf->Cell(52, 8,"DATE RANGE: ", 1, 0, 'L', true);

if($startDate == null) {
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0, 8,"  No date range", 1, 1, 'L');
} else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0, 8,"  ".$startDate." to ".$endDate, 1, 1, 'L');
}


$pdf->SetFont('Times','B',12);
$pdf->Cell(52, 8,"NUMBER OF STUDENT: ", 1, 0, 'L', true);

$pdf->SetFont('Times','',12);
$pdf->Cell(0, 8,"  ".$count." Students", 1, 1, 'L');
$pdf->ln(20);



/*---------------PIE CHART-----------------*/
$pdf->SetFont('Times', 'BIU', 14);
$pdf->Cell(0, 5, 'Graphical Representation', 0, 1);
$pdf->Ln(8);
$valX = $pdf->GetX();
$valY = $pdf->GetY();

$pdf->SetXY(55, $valY);
$col1=array(100,100,255);
$col2=array(255,100,100);
$pdf->PieChart(150, 45, $data, '%l (%p)', array($col1,$col2));
$pdf->SetXY($valX, $valY + 40);
$pdf->Ln(10);


/*---------------BODY-----------------*/

if($startDate == null) {
    $pdf->SetFont('Times','',12);
    $pdf->MultiCell(0, 8,"          This is an automatically generated report based on the filter that is being applied in the table of Student Vaccine Information. The data shows that ".$count." out of ".$totalCount." student/faculty or ".$percentage."% of the population in the Oceans of Knowledge High School have been selected using the filter: (".$check.").", 0, 'J');
    $pdf->ln(30);
} else{
    $pdf->SetFont('Times','',12);
    $pdf->MultiCell(0, 8,"          This is an automatically generated report based on the filter that is being applied in the table of Student Vaccine Information. The data shows that ".$count." out of ".$totalCount." student/faculty or ".$percentage."% of the population in the Oceans of Knowledge High School have been selected using the filter: (".$check.") and date of vaccination from ".$startDate." to ".$endDate.".", 0, 'J');
    $pdf->ln(30);
}



/*---------------SIGN PART-----------------*/
$pdf->Cell(80, 8, "Principal","1T",0,'C');
$pdf->Cell(25);
$pdf->Cell(80, 8, "Assistant Principal","1T",0,'C');







$pdf->Output("I", "OKHS_Report.pdf");
?>

