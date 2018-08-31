<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.tei-c.org/ns/1.0"  xpath-default-namespace="http://www.tei-c.org/ns/1.0">
	<xsl:output method="xml" encoding="utf-8" indent="yes"/>
	
	
	<xsl:template match="node() | @*">
		<xsl:copy>
			<xsl:apply-templates select="node() | @*"/>
		</xsl:copy>
	</xsl:template>
	
	<xsl:template match="note">
		<xsl:comment><xsl:value-of select="."/></xsl:comment>
	</xsl:template>
	
	<xsl:template match="TU_occupation" >
		<choice>
			<orig><rs type="occupation"><xsl:value-of select="."/></rs></orig>
			<xsl:if test="./@normal">
				<reg><rs type="occupation"><xsl:value-of select="./@normal"/></rs></reg>
			</xsl:if>
		</choice>
	</xsl:template>
	
	<xsl:template match="TU_adresse">
		<address><xsl:value-of select="."/></address>
	</xsl:template>

	<xsl:template match="TU_document">
		<xsl:variable name="atttype">
			<xsl:choose>
				<xsl:when test="not(./@type)">unspecified</xsl:when>
				<xsl:otherwise><xsl:value-of select="./@type"/></xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<bibl type="{$atttype}"><xsl:value-of select="."/></bibl>
	</xsl:template>
	
	<xsl:template match="TU_heure">
		<time><xsl:value-of select="."/></time>
	</xsl:template>
	
	<xsl:template match="TU_duree">
		<rs type="duration"><xsl:value-of select="."/></rs>
	</xsl:template>
	
	<xsl:template match="TU_incertitude">
		<certainty cert="low"><xsl:value-of select="./text()"/></certainty>
		<xsl:comment><xsl:value-of select="./note"/></xsl:comment>
	</xsl:template>
	
	<xsl:template match="TU_montant">
		<xsl:variable name="atttype">
			<xsl:choose>
			<xsl:when test="./@type = 'absolu'">absolute</xsl:when>
			<xsl:when test="./@type = 'relatif'">relative</xsl:when>
			<xsl:when test="not(./@type)">unspecified</xsl:when>
			<xsl:otherwise>error</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		
		<measure type="sum" subtype="{$atttype}"><xsl:value-of select="."/></measure>
	</xsl:template>
	
	<xsl:template match="TU_personne">
		<persName><xsl:value-of select="."/></persName>
	</xsl:template>
	
	<xsl:template match="TU_produit">
		<rs type="product"><xsl:value-of select="."/></rs>
	</xsl:template>
	
	<xsl:template match="TU_remuneration">
		<rs type="revenue"><xsl:value-of select="."/></rs>
	</xsl:template>
	
	<xsl:template match="TU_statutMatrimonial">
		<rs type="status"><xsl:value-of select="."/></rs>
	</xsl:template>
	
	<xsl:template match="TU_tache">
		<rs type="task"><xsl:value-of select="."/></rs>
	</xsl:template>
	
	<xsl:template match="TU_typeRemuneration">
		<xsl:variable name="atttype">
			<xsl:choose>
				<xsl:when test="not(./@type)">unspecified</xsl:when>
				<xsl:otherwise><xsl:value-of select="./@type"/></xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<rs type="revenue-type" subtype="{$atttype}"><xsl:value-of select="."/></rs>
	</xsl:template>
	
</xsl:stylesheet>



