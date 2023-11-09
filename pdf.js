function generatePDF(){
    const element = document.getElementById("pdf");


    html2pdf()
    .from(element)
    .save();
}