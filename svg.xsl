<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/2000/svg">

    <xsl:output method="xml" indent="yes" standalone="no" doctype-public="-//W3C//DTD SVG 1.1//EN"
        doctype-system="http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd" media-type="image/svg" />

    <xsl:variable name="width" select="800" />
    <xsl:variable name="height" select="420" />
    <xsl:variable name="margin" select="10" />
    <xsl:variable name="fullWidth" select="$width - $margin" />
    <xsl:variable name="fullHeight" select="$height - $margin" />

    <xsl:template match="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{height}">
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
            stroke="black"/>

        <text x="{$margin * 2}" y="{$margin * 3}" fill="rgb(255, 255, 255)" font-size="15">
            Wykonawcy - Ilość płyt
        </text>

        <rect x="{$margin * 2}" y="{$margin * 4}" width="{$fullWidth - 20}" height="{$chart}"
            fill="rgb(255, 255, 255)" stroke="black"/>

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
        <rect x="{($margin * 2) + ($linePadding * (position() div 2)) + ($lineWidth * (position() div 2 - 1))}"
            y="{$margin * 4 + ($chart - $lineStep * ilość_płyt)}" width="{$lineWidth}" height="{$lineStep * ilość_płyt}"
            fill="rgb(0, 0, 255)" stroke="black"/>
        <text y="{$margin * 6 + $chart}"
            x="{($margin * 2) + ($linePadding * (position() div 2)) + ($lineWidth * (position() div 2 - 1))
            + $lineWidth div 2}"  fill="rgb(255, 255, 255)" font-size="15"
            transform="rotate(90 {($margin * 2) + ($linePadding * (position() div 2)) + ($lineWidth * (position() div 2 - 1))
            + $lineWidth div 2}, {$margin * 6 + $chart})">
            <xsl:value-of select="nazwa" />
        </text>
    </xsl:template>
</xsl:stylesheet>
