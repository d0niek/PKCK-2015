<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/2000/svg">

    <xsl:output method="xml" indent="yes" standalone="no" doctype-public="-//W3C//DTD SVG 1.1//EN"
        doctype-system="http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd" media-type="image/svg" />

    <xsl:variable name="width" select="800" />
    <xsl:variable name="height" select="470" />
    <xsl:variable name="margin" select="10" />
    <xsl:variable name="fullWidth" select="$width - $margin" />
    <xsl:variable name="fullHeight" select="$height - $margin" />

    <xsl:template match="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{height}">
            <xsl:call-template name="definicje" />
            <xsl:apply-templates />
        </svg>
    </xsl:template>

    <xsl:template match="/kolekcja">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek" />

    <xsl:variable name="chart" select="250" />
    <xsl:template match="/kolekcja/wykonawcy">
        <rect x="{$margin}" y="{$margin}" width="{$fullWidth}" height="{$fullHeight}" fill="rgb(255, 120, 0)"
            stroke="black" id="ramka"/>

        <text x="{$margin * 2}" y="{$margin * 3}" fill="rgb(255, 255, 255)" font-size="25">
            Wykonawcy - Ilość płyt
        </text>

        <rect x="{$margin * 2}" y="{$margin * 4}" width="{$fullWidth - 20}" height="{$chart}"
            fill="rgb(255, 255, 255)" stroke="black"/>

        <xsl:call-template name="wybór" />
        <xsl:call-template name="skrypt" />
        <xsl:apply-templates />

    </xsl:template>

    <xsl:variable name="linePadding" select="10" />
    <xsl:variable name="lineWidth"
        select="($fullWidth - ($margin * 3) - ($linePadding * count(/kolekcja/wykonawcy/wykonawca))) div
        count(/kolekcja/wykonawcy/wykonawca)" />
    <xsl:variable name="lineStep">
        <xsl:for-each select="/kolekcja/wykonawcy/wykonawca">
            <xsl:sort select="ilość_płyt" data-type="number" order="descending"/>
            <xsl:if test="position() = 1">
                <xsl:value-of select="($chart - $linePadding) div ilość_płyt"/>
            </xsl:if>
        </xsl:for-each>
    </xsl:variable>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <xsl:variable name="rectX" select="round(($margin * 2) + ($linePadding * (position() div 2)) + ($lineWidth * (position() div 2 - 1)))" />
        <xsl:variable name="rectY" select="round($margin * 4 + ($chart - $lineStep * ilość_płyt))" />

        <rect x="{($rectX)}" y="{($rectY)}" width="{$lineWidth}" height="{$lineStep * ilość_płyt}" fill="url(#Gradient)" stroke="black">
            <animateTransform id="trigger" begin="click" attributeName="transform" type="rotate"
                          from="0 {($rectX)} {($rectY)}" to="360 {($rectX)} {($rectY)}" dur="1s" repeatCount="2" />
        </rect>
        <text y="{$margin * 6 + $chart}"
            x="{($margin * 2) + ($linePadding * (position() div 2)) + ($lineWidth * (position() div 2 - 1))
            + $lineWidth div 2}"  fill="rgb(255, 255, 255)" font-size="20"
            transform="rotate(90 {($margin * 2) + ($linePadding * (position() div 2)) + ($lineWidth * (position() div 2 - 1))
            + $lineWidth div 2}, {$margin * 6 + $chart})">
            <xsl:value-of select="nazwa" />
        </text>
    </xsl:template>

    <xsl:template name="definicje">
        <defs>
            <linearGradient id="Gradient" x1="100%" y1="100%">
                <stop offset="0%" stop-color="lightblue" stop-opacity=".5">
                    <animate attributeName="stop-color" values="lightblue;blue;red;red;black;red;red;purple;lightblue" dur="14s" repeatCount="indefinite" />
                </stop>
                <stop offset="100%" stop-color="lightblue" stop-opacity=".5">
                    <animate attributeName="stop-color" values="lightblue;orange;purple;purple;black;purple;purple;blue;lightblue" dur="14s" repeatCount="indefinite" />
                    <animate attributeName="offset" values=".95;.80;.60;.40;.20;0;.20;.40;.60;.80;.95" dur="14s" repeatCount="indefinite" />
                 </stop>
            </linearGradient>
        </defs>
    </xsl:template>

    <xsl:template name="skrypt">
        <script type="text/javascript">
            <![CDATA[
                var ramka = document.getElementById("ramka");
                var col1 = document.getElementById("col1");
                var col2 = document.getElementById("col2");
                var col3 = document.getElementById("col3");

                col1.onclick = function() {
                    var color = this.getAttribute("fill");
                    ramka.setAttribute("fill","rgb(255, 204, 255)");
                }

                col2.onclick = function() {
                    var color = this.getAttribute("fill");
                    ramka.setAttribute("fill","rgb(204, 255, 153)");
                }

                col3.onclick = function() {
                    var color = this.getAttribute("fill");
                    ramka.setAttribute("fill","rgb(255, 120, 0)");
                }
            ]]>
        </script>
    </xsl:template>

    <xsl:template name="wybór">
        <xsl:variable name="boxSize" select="40" />
        <rect x="{$margin}" y="{$margin + $fullHeight}" width="{$boxSize}" height="{$boxSize}" fill="rgb(255, 204, 255)" stroke="black" id="col1" />
        <rect x="{$margin + 1.2* $boxSize}" y="{$margin + $fullHeight}" width="{$boxSize}" height="{$boxSize}" fill="rgb(204, 255, 153)" stroke="black" id="col2" />
        <rect x="{$margin + 2.4 * $boxSize}" y="{$margin + $fullHeight}" width="{$boxSize}" height="{$boxSize}" fill="rgb(255, 120, 0)" stroke="black" id="col3" />
    </xsl:template>

</xsl:stylesheet>
