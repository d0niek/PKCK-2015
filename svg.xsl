<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/2000/svg">

    <xsl:output method="xml" indent="yes" standalone="no" doctype-public="-//W3C//DTD SVG 1.1//EN"
        doctype-system="http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd" media-type="image/svg" />

    <xsl:variable name="width" select="800" />
    <xsl:variable name="height" select="600" />
    <xsl:variable name="margin" select="10" />
    <xsl:variable name="fullWidth" select="$width - $margin" />
    <xsl:variable name="fullHeight" select="$height - $margin" />

    <xsl:template match="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{$height}" >
            <xsl:apply-templates />
        </svg>
    </xsl:template>

    <xsl:template match="/kolekcja">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek" />

    <xsl:template match="/kolekcja/wykonawcy">
        <rect x="{$margin}" y="{$margin}" width="{$fullWidth}" height="{$fullHeight}" fill="rgb(255, 120, 0)"
            stroke="black"/>
        <text x="{$margin + 10}" y="{$margin + 20}" fill="rgb(255, 255, 255)" font-size="15">Wykonawcy</text>
        <rect x="{$margin * 2}" y="{$margin * 2 + 20}" width="{$fullWidth - 20}" height="200"
            fill="rgb(255, 255, 255)" stroke="black"/>
    </xsl:template>
</xsl:stylesheet>
